<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Recurring;
use App\RecurringPick;

class MonthlyRecurring extends Command
{
    protected $signature = 'recurring:monthly';
    protected $description = 'Genera le schede per le donazioni mensili';

    public function handle()
    {
        if(env('HAS_FOOD', false)) {
            Recurring::generateMonthly();
        }
    }
}
