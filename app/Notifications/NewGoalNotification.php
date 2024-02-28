<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewGoalNotification extends Notification
{
    use Queueable;
    protected $meta;

    public function __construct($meta)
    {
        $this->meta = $meta;

    }

    public function via ($notifiable) {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Tens uma meta nova: ' . $this->meta->titulos->titulo,
            'titulo'=> $this->meta->titulos->titulo,
            'idmeta'=> $this->meta->idMeta,
        ];
    }


}
