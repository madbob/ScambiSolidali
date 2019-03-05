<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Recurring;

class WeeklyRecurring extends Command
{
    protected $signature = 'recurring:weekly';
    protected $description = 'Genera le schede per le donazioni settimanali';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if(env('HAS_FOOD', false)) {
            Recurring::weekly()->where('closed', false)->update(['closed' => true]);
            Recurring::generateWeekly();
        }
    }
}
