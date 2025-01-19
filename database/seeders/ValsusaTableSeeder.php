<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Concerns\CategoriesSeeder;

class ValsusaTableSeeder extends Seeder
{
    use CategoriesSeeder;

    public function run()
    {
        $confs = [
            'main_tagline' => 'mettiamo in contatto chi opera nel sociale con chi ha qualcosa da regalare!',
            'homebox_title' => sprintf("<strong>%s</strong> è una piattaforma che migliora la vita<br/>delle persone in difficoltà che ti stanno attorno. Ti permette di:", env('APP_NAME')),
            'facebook_link' => 'https://www.facebook.com/celocelo-190331531485606/',
            'instance_city' => 'Val Susa',
            'explicit_zones' => 'false',
            'other_instance_cities' => '[{"name":"Torino", "url":"https://celocelo.it/"}, {"name":"Novara", "url":"https://novara.celocelo.it/"}, {"name":"Milano", "url":"https://milano.celocelo.it/"}]',
            'powered_by' => 'Consorzio Intercomunale Socio-Assistenziale Val Susa',
            'owner_address' => 'piazza San Francesco 4, 10059, Susa (TO)',
            'video_link' => 'https://www.youtube-nocookie.com/embed/pGZURLZQZ7w?rel=0&amp;controls=0&amp;showinfo=0',
            'players_map_coordinates' => '7.3126, 45.0997',
            'players_map_zoom' => '9',
            'contact_main' => 'Consorzio Intercomunale Socio-Assistenziale<br>Valle di Susa',
            'contact_contents' => 'piazza San Francesco 4 - 10059 Susa (TO)<br>celocelo@conisa.it<br>T 011 9311392',
            'contact_map_coordinates' => '7.04585, 45.13409',
            'contact_map_title' => 'Con.I.S.A.',
        ];

        $this->saveConfigs($confs);
        $this->populateDefaultCategories();
    }
}
