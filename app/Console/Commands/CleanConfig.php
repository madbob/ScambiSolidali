<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Config;

class CleanConfig extends Command
{
    protected $signature = 'clean:config';
    protected $description = 'Svuota le configurazioni dell\'istanza';

    public function handle()
    {
        Config::where('id', '>', 0)->delete();
    }
}
