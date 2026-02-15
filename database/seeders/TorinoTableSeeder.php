<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Vite;

use Database\Seeders\Concerns\CategoriesSeeder;

class TorinoTableSeeder extends Seeder
{
    use CategoriesSeeder;

    public function run()
    {
        $confs = [
            'main_tagline' => 'mettiamo in contatto chi opera nel sociale con chi ha qualcosa da regalare!',
            'homebox_title' => sprintf("<strong>%s</strong> è una piattaforma che migliora la vita<br/>delle persone in difficoltà che ti stanno attorno. Ti permette di:", env('APP_NAME')),
            'facebook_link' => 'https://www.facebook.com/celocelo-190331531485606/',
            'instance_city' => 'Torino',
            'explicit_zones' => 'false',
            'operator_manual' => resource_path('docs/manuale_operatori_celocelo.pdf'),
            'other_instance_cities' => '[{"name":"Milano", "url":"https://milano.celocelo.it/"}, {"name":"Novarese", "url":"https://novarese.celocelo.it/"}, {"name":"Val Susa", "url":"https://valsusa.celocelo.it/"}]',
            'powered_by' => 'Ass. Agenzia per lo sviluppo locale di San Salvario ETS',
            'owner_address' => 'via Morgari 14, 10125, Torino',
            'video_link' => 'https://www.youtube-nocookie.com/embed/pGZURLZQZ7w?rel=0&amp;controls=0&amp;showinfo=0',
            'players_map_coordinates' => '7.67824, 45.05408',
            'players_map_zoom' => '12',
            'contact_main' => 'Ass. Agenzia per lo sviluppo di San Salvario onlus<br>c/o Casa del Quartiere San Salvario',
            'contact_contents' => 'via Morgari 14 - 10125 Torino<br>segreteria@agenzia.sansalvario.org<br>T 011 6686772',
            'contact_map_coordinates' => '7.67824, 45.05408',
            'contact_map_title' => 'Casa del Quartiere',
            'expiration' => 2,

            'food_full_credits' => sprintf('<p class="intro">Un progetto di</p>
                <p>Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS, Equoevento ONLUS</p>
                <p class="intro"><br>In collaborazione con</p>
                <p>Stranaidea Impresa Sociale ONLUS</p><img src="%s" alt="Agenzia per lo Sviluppo Locale di San Salvario ONLUS"><img src="%s" alt="Equoevento ONLUS"><img src="%s" alt="Stradaidea Impresa Sociale ONLUS"><p class="intro"><br><br>Con il sostegno di</p><img src="%s" alt="Compagnia di San Paolo"><img src="%s" alt="Iren"><p class="details"><br>nell\'ambito del bando "Fatto per Bene 2018"</p>',
                Vite::asset('resources/images/agenziasansalvario.jpg'),
                Vite::asset('resources/images/equoevento.jpg'),
                Vite::asset('resources/images/stranaidea.jpg'),
                Vite::asset('resources/images/csp.png'),
                Vite::asset('resources/images/iren.jpg')),
        ];

        $this->saveConfigs($confs);
        // $this->populateDefaultCategories();
    }
}
