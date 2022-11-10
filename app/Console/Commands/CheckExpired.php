<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail;
use Log;
use DB;

use App\Mail\ExpirationNotify;
use App\Mail\ExpirationCallNotify;
use App\Mail\ExpiredNotify;
use App\Donation;
use App\Call;
use App\User;

class CheckExpired extends Command
{
    protected $signature = 'check:expired';
    protected $description = 'Verifica la scadenza degli annunci e degli appelli pubblicati';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $limit_notification = strtotime('-2 months');
        $limit_date = date('Y-m-d H:i:s', $limit_notification);

        $limit_deletion = $limit_notification - (60 * 60 * 24 * 7);
        $final_limit_date = date('Y-m-d H:i:s', $limit_deletion);

        Donation::where('type', 'object')->where('status', 'expiring')->where('updated_at', '<', $limit_date)->update(['status' => 'expired']);
        Donation::where('type', 'object')->where('status', 'expired')->where('updated_at', '<', $final_limit_date)->update(['status' => 'dropped']);

        $pending = Donation::where('type', 'object')->where('status', 'pending')->where('updated_at', '<', $limit_date)->get();
        foreach($pending as $pen) {
            Mail::to($pen->user->email)->send(new ExpirationNotify($pen));
            Log::info('Sent expiration notice for donation ' . $pen->id);
            $pen->status = 'expiring';
            $pen->save();
        }

        $final_limit_date = date('Y-m-d', strtotime('-7 days'));
        Call::where('status', 'open')->where(DB::raw('DATE(`when`)'), '<', $final_limit_date)->update(['status' => 'archived']);

        $today = date('Y-m-d');
        $pending = Call::where('status', 'open')->where(DB::raw('DATE(`when`)'), $today)->get();
        foreach($pending as $pen) {
            Mail::to($pen->user->email)->send(new ExpirationCallNotify($pen));
            Log::info('Sent expiration notice for call ' . $pen->id);
        }
    }
}
