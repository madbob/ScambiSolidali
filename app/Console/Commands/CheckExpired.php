<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail;
use Log;

use App\Mail\ExpirationNotify;
use App\Mail\ExpiredNotify;
use App\Donation;
use App\User;

class CheckExpired extends Command
{
    protected $signature = 'check:expired';
    protected $description = 'Verifica la scadenza degli annunci pubblicati';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $limit_notification = strtotime('-1 months');

        $limit_deletion = $limit_notification - (60 * 60 * 24 * 7);
        $limit_date = date('Y-m-d H:i:s', $limit_notification);

        Donation::where('type', 'object')->where('status', 'expiring')->where('updated_at', '<', $limit_date)->update(['status' => 'expired']);
        Donation::where('type', 'object')->where('status', 'expired')->where('updated_at', '<', $limit_date)->update(['status' => 'dropped']);

        $limit_date = date('Y-m-d H:i:s', $limit_notification);
        $pending = Donation::where('type', 'object')->where('status', 'pending')->where('updated_at', '<', $limit_date)->get();
        foreach($pending as $pen) {
            Mail::to($pen->user->email)->send(new ExpirationNotify($pen));
            Log::info('Sent expiration notice for donation ' . $pen->id);
            $pen->status = 'expiring';
            $pen->save();
        }
    }
}
