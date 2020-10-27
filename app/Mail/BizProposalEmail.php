<?php

namespace App\Mail;

use App\BizProposal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BizProposalEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $proposal;
    public $subject;


    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(BizProposal $proposal, $subject='')
     {
         $this->proposal = $proposal;
         $this->subject = $subject;

     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $specialization = $this->proposal->specialization->only('name');
        $festival = $this->proposal->festival->only('name');
        $place_format = $this->proposal->placeformat->only('name');

        $message =  $this->from(\Config::get('mail.from'))
                    ->subject($this->subject)
                    ->text('mails.bizproposal')
                    ->with(
                      [
                            'member' => json_decode($this->proposal->member)->ru,
                            'phone' => $this->proposal->phone,
                            'specialization' => $this->proposal->specialization ? json_decode($specialization['name'])->ru : '',
                            'date' => $this->proposal->created_at,
                            'festival' => $this->proposal->festival ? json_decode($festival['name'])->ru : '',
                            'social' => json_decode($this->proposal->social),
                            'count_worker' =>  $this->proposal->count_worker,
                            'place_number' =>  $this->proposal->place_number,
                            'place_format' => $this->proposal->placeformat ? json_decode($place_format['name'])->ru : '',                            
                            'fitting_room' => ($this->proposal->fitting_room>0 ) ? 'Нужна' : 'Не нужна',
                            'illumination' => $this->proposal->illumination ?? 'Не нужно',
                            'product' => $this->proposal->product,
                            'comment' => $this->proposal->comment,     
                              
                      ]);
        $files = json_decode($this->proposal->fotos); 

        if($files > 0) {
            foreach ($files as $file) { 
                $message->attach(config('app.url') . $file); // attach each file
            }
        }
        return $message; //Send mail      
    }
}
