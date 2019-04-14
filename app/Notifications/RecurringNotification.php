<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use MadBob\LaravelNotification\Mobyt\MobytChannel;
use MadBob\LaravelNotification\Mobyt\MobytMessage;

class RecurringNotification extends Notification
{
    use Queueable;

    private $recurring;

    public function __construct($recurring)
    {
        $this->recurring = $recurring;
    }

    public function via($notifiable)
    {
        return [MobytChannel::class];
    }

    public function toMobyt($notifiable)
    {
        return (new MobytMessage())->content("E' ora di compilare le disponibilità di prodotti per CeloCelo Food! Clicca qui per procedere: " . $this->recurring->link);
    }
}
