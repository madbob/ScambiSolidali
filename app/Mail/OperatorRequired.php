<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OperatorRequired extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $subject = sprintf('%s: richiesta accesso operatore', env('APP_NAME'));
        return $this->subject($subject)->view('mails.operatorrequired')->with(['user' => $this->user]);
    }
}
