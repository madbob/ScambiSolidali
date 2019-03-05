<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Recurring;
use App\RecurringPick;

class MonthlyRecurring extends Command
{
    protected $signature = 'recurring:monthly';
    protected $description = 'Genera le schede per le donazioni mensili';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if(env('HAS_FOOD', false)) {
            Recurring::monthly()->where('closed', false)->update(['closed' => true]);
            RecurringPick::where('closed', false)->update(['closed' => true]);
            Recurring::generateMonthly();
        }
    }
}
