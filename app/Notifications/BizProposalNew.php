<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;
use App\BizProposal;

class BizProposalNew extends Notification implements ShouldQueue
{
    use Queueable;

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
        $place_format = $this->proposal->placeformat->only('name');
        $social = json_decode($this->proposal->social);

        $content = $this->subject . PHP_EOL;
        $content .= PHP_EOL;
        $content .= 'Данные торгового места на фестиваль: ' .  ($this->proposal->festival ? json_decode($festival['name'])->ru : '') . PHP_EOL ;
        $content .= '------------------------------' . PHP_EOL ;
        $content .= 'ФИО: ' . json_decode($this->proposal->member)->ru . PHP_EOL ;
        $content .= 'Специализация: ' . ($this->proposal->specialization ? json_decode($specialization['name'])->ru : '') . PHP_EOL ;
        $content .= 'Описание продукции: ' . ($this->proposal->product) . PHP_EOL ;
        $content .= 'Количество сотрудников: ' . ($this->proposal->count_worker) . PHP_EOL ;
        $content .= 'Номер места: ' . ($this->proposal->place_number) . PHP_EOL ;
        $content .= 'Формат места: ' . ($this->proposal->placeformat ? json_decode($place_format['name'])->ru : '') . PHP_EOL ;
        $content .= 'Дополнительное освещение, Вт: ' . ($this->proposal->illumination ?? 'Не нужно') . PHP_EOL ;
        $content .= 'Примерочная: '. (($this->proposal->fitting_room>0 ) ? 'Нужна' : 'Не нужна') . PHP_EOL ;
        $content .= 'Контакты: ' . PHP_EOL ;
        $content .= 'Телефон: ' . ($this->proposal->phone) . PHP_EOL ;
        $content .= 'Facebook: ' . ($social->facebook ). PHP_EOL ;
        $content .= 'Instagram: ' . ($social->instagram) . PHP_EOL ;
        $content .= 'Website: ' . ($social->website) . PHP_EOL ;
        $content .= 'Email: ' . ($social->email) . PHP_EOL ;

        $content .= 'Комментарий: ' . $this->proposal->comment . PHP_EOL ;
        $content .= 'Дата создания: ' . $this->proposal->created_at . PHP_EOL ;
        $content .= PHP_EOL ;
        $content .= 'p.s. Все фотоматериалы в следующем сообщении(-ях)' . PHP_EOL ;
        $content .= '------------------------------' . PHP_EOL ;
          
        $message =  TelegramMessage::create()
            ->to($notifiable->telegram_user_id)
            ->content($content);

        return $message; //Send mail              
/*

Количество сотрудников: {{ $count_worker }}
Номер места: {{ $place_number }}
Формат места: {{ $place_format }}
Дополнительное освещение, Вт: {{ $illumination }}
Примерочная: {{ $fitting_room }}
Контакты
    Телефон: {{ $phone }}
    Facebook: {{ $social->facebook }}
    Instagram: {{ $social->instagram }}
    Website: {{ $social->website }}
    Email: {{ $social->email }}
Комментарий: {{ $comment }}
Дата создания: {{ $date }} */
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
