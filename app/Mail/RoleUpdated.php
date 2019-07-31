<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RoleUpdated extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $subject = sprintf('%s: account aggiornato', env('APP_NAME'));
        return $this->subject($subject)->view('mails.roleupdated')->with(['user' => $this->user]);
    }
}
