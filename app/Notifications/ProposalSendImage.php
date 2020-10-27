<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;


class ProposalSendImage extends Notification implements ShouldQueue
{
    use Queueable;

    public $subject;
    public $file;


    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct( $subject='', $file)
     {
         $this->subject = $subject;
         $this->file = $file;

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
        $content  = $this->subject . PHP_EOL;
        return  TelegramFile::create()
            ->to($notifiable->telegram_user_id)
            ->content($content)
            ->file($this->file, 'photo');

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
