<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\Donation;

class RemoveOldImages extends Command
{
    protected $signature = 'remove:images';
    protected $description = 'Elimina gli assets S3 relativi a contenuti eliminati';

    public function handle()
    {
        $basefolder = currentInstance();
        $files = Storage::disk('images')->files($basefolder);

        foreach($files as $file) {
            $file = basename($file);
            if (strpos($file, '_') !== false) {
                list($id, $index) = explode('_', $file);
                $donation = Donation::find($id);
                if (is_null($donation)) {
                    Storage::disk('images')->delete($basefolder . '/' . $file);
                    $this->info('Eliminato ' . $basefolder . '/' . $file);
                }
            }
        }
    }
}
