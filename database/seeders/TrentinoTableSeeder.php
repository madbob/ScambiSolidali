<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Concerns\CategoriesSeeder;
use App\Config;

class TrentinoTableSeeder extends Seeder
{
    use CategoriesSeeder;

    public function run()
    {
        if (Config::where('name', 'strings')->first() == null) {
            $strings = [
                'Cosa è successo' => 'Storie',
                'Giocatori' => 'Accreditati',
                'Vincitori' => 'Storie',
                'Celo!' => 'Dono!',
                'Manca!' => 'Cerco!',
                'Celo' => 'Dono',
                'Manca' => 'Cerco',
                'Storie a lieto fine' => 'Successi',
                'STORIE DI SUCCESSO' => 'STORIE A LIETO FINE',
                'Lieto fine' => '',
                'Contatti' => 'Chi Siamo',
                'Vuoi scoprire che fine ha fatto il tuo frigo? Qui ti raccontiamo le storie di successo di' => 'Vuoi scoprire che fine ha fatto il tuo dono? Qui ti raccontiamo le storie di successo di',
                'Qui puoi inserire il tuo annuncio!<br/>Dicci cosa vuoi regalare e attendi la nostra risposta!' => 'Qui puoi inserire il tuo annuncio.<br/>Pubblica cosa vuoi donare e attendi di essere contattato.',
                "Guarda cosa ci manca!<br/>Ce l'hai?<br/>Rispondi alle nostre call, ti contatteremo appena possibile!" => "Controlla le necessità! Se ce l'hai, rispondi agli appelli e ti contatteremo presto!",
                'IL PROGETTO' => 'IL PROGETTO DONOTRENTINO',
                'Inserisci il tuo annuncio' => 'Vedi o inserisci un dono',
                'Ci puoi aiutare?' => 'Vedi o inserisci un appello',
                'PER INFORMAZIONI' => 'PROGETTO PROMOSSO DA',
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
            'main_tagline' => 'mettiamo in contatto chi opera nel sociale con chi ha qualcosa da donare!',
            'homebox_title' => sprintf("<strong>%s</strong> è una piattaforma che migliora la vita<br/>delle persone in difficoltà che ti stanno attorno. Ti permette di:", env('APP_NAME')),
            'facebook_link' => 'https://www.facebook.com/DonoTrentino',
            'instagram_link' => 'https://www.instagram.com/donotrentino/',
            'youtube_link' => 'https://www.youtube.com/channel/UCBW6U2L6YJ6U47Cv5nF5DdQ',
            'instance_city' => 'Trentino',
            'explicit_zones' => 'true',
            'other_instance_cities' => '[]',
            'powered_by' => 'Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS',
            'owner_address' => 'via Morgari 14, 10125, Torino',
            'video_link' => 'https://www.youtube-nocookie.com/embed/39SihdTfEQc?rel=0&amp;controls=0&amp;showinfo=0',
            'players_map_coordinates' => '11.1255, 46.0651',
            'players_map_zoom' => '12',
            'contact_main' => 'TRENTINOSOLIDALE',
            'contact_contents' => 'Viale Bolognini 98 - Trento<br>segreteria@donotrentino.it',
            'contact_map_coordinates' => '11.13669, 46.06510',
            'contact_map_title' => 'TRENTINOSOLIDALE',
        ];

        $this->saveConfigs($confs);
        // $this->populateDefaultCategories();
    }
}
