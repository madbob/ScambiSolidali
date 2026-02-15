<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Vite;

use Database\Seeders\Concerns\CategoriesSeeder;

class NovaraTableSeeder extends Seeder
{
    use CategoriesSeeder;

    public function run()
    {
        $confs = [
            'main_tagline' => 'mettiamo in contatto chi opera nel sociale con chi ha qualcosa da regalare!',
            'homebox_title' => sprintf("<strong>%s</strong> è una piattaforma che migliora la vita<br/>delle persone in difficoltà che ti stanno attorno. Ti permette di:", env('APP_NAME')),
            'instance_city' => 'Novara',
            'explicit_zones' => 'false',
            'operator_manual' => resource_path('docs/manuale_operatori_celocelo.pdf'),
            'other_instance_cities' => '[{"name":"Torino", "url":"https://celocelo.it/"}, {"name":"Milano", "url":"https://milano.celocelo.it/"}, {"name":"Val Susa", "url":"https://valsusa.celocelo.it/"}]',
            'powered_by' => 'Il Mestiere del Sole APS',
            'owner_address' => 'via Fascia Rossa, 35 - 28021 Borgomanero (NO)',
            'video_link' => 'https://www.youtube-nocookie.com/embed/pGZURLZQZ7w?rel=0&amp;controls=0&amp;showinfo=0',
            'players_map_coordinates' => '8.4967369, 45.6839817',
            'players_map_zoom' => '12',
            'contact_main' => 'Il Mestiere del Sole APS',
            'contact_contents' => 'via Fascia Rossa, 35 - 28021 Borgomanero (NO)<br>celocelo@ilmestieredelsole.it<br><a href="http://www.ilmestieredelsole.it/">www.ilmestieredelsole.it</a><br>T 370 3093224 (preferibilmente Whatsapp)',
            'contact_map_coordinates' => '8.4967369, 45.6839817',
            'contact_map_title' => 'Il Mestiere del Sole',
            'expiration' => 2,
        ];

        $this->saveConfigs($confs);
        // $this->populateDefaultCategories();
    }
}
