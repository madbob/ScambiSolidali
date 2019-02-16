<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Recurring;

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
        Recurring::monthly()->where('closed', false)->update(['closed' => true]);
        Recurring::generateMonthly();
    }
}
