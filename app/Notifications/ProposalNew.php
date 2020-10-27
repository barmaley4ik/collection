<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;
use App\Proposal;

class ProposalNew extends Notification implements ShouldQueue
{
    use Queueable;

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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $specialization = $this->proposal->specialization->only('name');
        $festival = $this->proposal->festival->only('name');
        $country = $this->proposal->country->only('name');
        $place_format = $this->proposal->placeformat->only('name');
        $social = json_decode($this->proposal->social);

        $content = $this->subject . PHP_EOL;
        $content .= PHP_EOL;
        $content .= 'Данные участника на фестиваль: ' .  ($this->proposal->festival ? json_decode($festival['name'])->ru : '') . PHP_EOL ;
        $content .= '------------------------------' . PHP_EOL ;
        $content .= 'ФИО: ' . json_decode($this->proposal->member)->ru . PHP_EOL ;
        $content .= 'Студия: ' . json_decode($this->proposal->studio)->ru . PHP_EOL ;
        $content .= 'Специализация: ' . ($this->proposal->specialization ? json_decode($specialization['name'])->ru : '' ). PHP_EOL ;
       // $content .= 'Количество сотрудников: ' . $this->proposal->count_worker . PHP_EOL ;
        $content .= 'Номер места: ' . $this->proposal->place_number . PHP_EOL ;
        $content .= 'Формат места: ' . ($this->proposal->placeformat ? json_decode($place_format['name'])->ru : '') . PHP_EOL ;
        $content .= 'Контакты: ' . PHP_EOL ;
        $content .= 'Телефон: ' . $this->proposal->phone . PHP_EOL ;
        $content .= 'Facebook: ' . $social->facebook . PHP_EOL ;
        $content .= 'Instagram: ' . $social->instagram . PHP_EOL ;
        $content .= 'Website: ' . $social->website . PHP_EOL ;
        $content .= 'Email: ' . $social->email . PHP_EOL ;
        $content .= 'Страна: ' . ($this->proposal->country ? json_decode($country['name'])->ru : '') . PHP_EOL ;
        $content .= 'Город: ' . json_decode($this->proposal->city)->ru . PHP_EOL ;
        $content .= 'Комментарий: ' . $this->proposal->comment . PHP_EOL ;
        $content .= 'Дата создания: ' . $this->proposal->created_at . PHP_EOL ;
        $content .= PHP_EOL ;
        $content .= 'p.s. Все фотоматериалы в следующем сообщении(-ях)' . PHP_EOL ;
        $content .= '------------------------------' . PHP_EOL ;
          
        $message =  TelegramMessage::create()
            ->to($notifiable->telegram_user_id)
            ->content($content);

        return $message; //Send mail              

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
