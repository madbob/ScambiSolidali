<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;

class OptimizeImages extends Command
{
    protected $signature = 'resize:images';
    protected $description = 'Per ottimizzare a posteriori le immagini';

    public function handle()
    {
        $manager = ImageManager::gd();

        $basefolder = currentInstance();
        echo $basefolder . "\n";
        $files = Storage::disk('images')->files($basefolder);

        foreach($files as $file) {
            $content = Storage::disk('images')->get($file);
            $path = tempnam(sys_get_temp_dir(), 'resize_');
            file_put_contents($path, $content);

            try {
                $image = $manager->read($path);
                $image->scale(width: 350);
                $encoded = (string) $image->toWebp(80);
                Storage::disk('images')->put($file, $encoded, 'public');
            }
            catch(\Exception $e) {
                echo "\nerrore file " . $file . ': ' . $e->getMessage() . "\n";
            }

            @unlink($path);
            echo '.';
        }
    }
}
