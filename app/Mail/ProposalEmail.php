<?php

namespace App\Mail;


use App\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ProposalEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $proposal;
    public $subject;


    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Proposal $proposal, $subject='')
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
        $country = $this->proposal->country->only('name');
        $place_format = $this->proposal->placeformat->only('name');

        $message =  $this->from(\Config::get('mail.from'))
                    ->subject($this->subject)
                    ->text('mails.proposal')
                    ->with(
                      [
                            'member' => json_decode($this->proposal->member)->ru,
                            'studio' => json_decode($this->proposal->studio)->ru,
                            'phone' => $this->proposal->phone,
                            'specialization' => $this->proposal->specialization ? json_decode($specialization['name'])->ru : '',
                            'social' => json_decode($this->proposal->social),
                            'count_worker' =>  $this->proposal->count_worker,
                            'place_number' =>  $this->proposal->place_number,
                            'festival' => $this->proposal->festival ? json_decode($festival['name'])->ru : '',
                            'country' => $this->proposal->country ? json_decode($country['name'])->ru : '',
                            'place_format' => $this->proposal->placeformat ? json_decode($place_format['name'])->ru : '',
                            'city' => json_decode($this->proposal->city)->ru,
                            'comment' => $this->proposal->comment,     
                            'date' => $this->proposal->created_at,                            
                      ]);

        $message->attach(config('app.url') . $this->proposal->logo); 

        $files = json_decode($this->proposal->portfolio); 

        if($files > 0) {
            foreach ($files as $file) { 
                $message->attach(config('app.url') . $file); // attach each file
            }
        }
        return $message; //Send mail                              
    }
}
