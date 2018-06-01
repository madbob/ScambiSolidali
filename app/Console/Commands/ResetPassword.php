<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Hash;

use App\User;

class ResetPassword extends Command
{
    protected $signature = 'reset:password {user_email} {password}';
    protected $description = 'Per modificare la password di un utente, data la sua email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $user_mail = $this->argument('user_email');
        $password = $this->argument('password');

        $user = User::where('email', $user_mail)->first();
        if(is_null($user)) {
            echo "Utente non trovato.\n";
            exit();
        }

        $user->password = Hash::make($password);
        $user->save();
        echo "Password resettata.\n";
    }
}
