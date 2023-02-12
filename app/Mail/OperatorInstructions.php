<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Config;

class OperatorInstructions extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
		$manual_path = Config::getConf('operator_manual');
        $subject = sprintf('%s: manuale operatore', env('APP_NAME'));
        return $this->subject($subject)->view('mails.operatormanual')->with(['user' => $this->user])->attach($manual_path);
    }
}
