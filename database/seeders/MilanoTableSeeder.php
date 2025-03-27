<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Vite;

use Database\Seeders\Concerns\CategoriesSeeder;
use App\Config;

class MilanoTableSeeder extends Seeder
{
    use CategoriesSeeder;

    public function run()
    {
        if (Config::where('name', 'strings')->first() == null) {
            $strings = [
                'Operatore' => 'Giovane Milano2035',
            ];

            $obj = [];

            foreach($strings as $original => $custom) {
                $obj[] = (object) [
                    'original' => $original,
                    'custom' => $custom,
                ];
            }

            $c = new Config();
            $c->name = 'strings';
            $c->value = json_encode($obj);
            $c->save();
        }

        $confs = [
            'main_tagline' => 'mettiamo in contatto i giovani abitanti del progetto Milano 2035 con chi vuole donare beni per la casa!',
            'homebox_title' => sprintf("<strong>%s</strong> è una piattaforma che supporta i giovani abitanti del progetto <a href=\"http://www.milano2035.it\">Milano 2035</a>. Ti permette di:", env('APP_NAME')),
            'facebook_link' => 'https://www.facebook.com/Milano2035/',
            'instance_city' => 'Milano',
            'explicit_zones' => 'false',
            'other_instance_cities' => '[{"name":"Torino", "url":"https://celocelo.it/"}, {"name":"Novarese", "url":"https://novarese.celocelo.it/"}, {"name":"Val Susa", "url":"https://valsusa.celocelo.it/"}]',
            'powered_by' => 'Milano 2035',
            'owner_address' => '',
            'cover_link' => Vite::asset('resources/images/cartolina_milano.png'),
            'players_map_coordinates' => '9.1835, 45.4710',
            'players_map_zoom' => '12',
            'contact_main' => 'Milano 2035',
            'contact_contents' => 'touchpoint@milano2035.it<br><br>Touch Point presso Off Campus San Siro,<br>Via Giacinto Gigante, di fronte al n. 5, Milano (MI)<br>tutti i lunedì dalle 14.30 alle 17.30<br><br>Touch Point presso Cofò<br>Via Carlo Martinelli, 23 Cinisello Balsamo (MI)<br>dalle 8.00 alle 20.00',
            'contact_map_coordinates' => '9.13835, 45.47117',
            'contact_map_title' => 'Milano 2035',
        ];

        $this->saveConfigs($confs);

        /*
        $this->populateCategories([
            'object' => [
                'Casa' => (object) [
                    'children' => [
                        'Arredamento',
                        'Biancheria',
                        'Elettrodomestici',
                        'Elettronica',
                        'Stoviglie',
                        'Utensili',
                    ],
                ],
            ],
            'service' => [
                'Abitare Collaborativo' => (object) [
                    'children' => [
                        'Piccole riparazioni e manutenzioni',
                        'Feste e piccoli eventi di vicinato',
                        'Aiuto nello studio',
                        'Aiuto nelle faccende di casa',
                        'Aiuto nelle pratiche burocratiche',
                        'Accompagnamento persone (spesa, uffici, ecc.)',
                        'Cura animali domestici',
                        'Condivisione auto/moto/bici',
                        'Gruppo di acquisto alimentari',
                        'Volontariato nel quartiere',
                        'Volontariato nel progetto Milano 2035',
                        'Altro',
                    ],
                ]
            ]
        ]);
        */
    }
}
