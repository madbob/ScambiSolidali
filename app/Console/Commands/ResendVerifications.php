<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Mail;

use App\User;

class ResendVerifications extends Command
{
    protected $signature = 'resend:verifications {since_day}';
    protected $description = 'Rimanda le mail di verifica account';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $since = $this->argument('since_day');
        $users = User::where('verification_code', '!=', '')->whereRaw("DATE(created_at) > '$since'")->get();

        foreach($users as $user) {
            echo "Mando mail a " . $user->email . "\n";

            Mail::send('mails.activation', ['user' => $user], function($message) use ($user){
                $message->to($user->email);
                $message->subject(env('APP_NAME') . ': attivazione account');
            });
        }
    }
}
