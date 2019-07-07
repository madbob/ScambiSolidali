<?php

use Illuminate\Database\Seeder;

use App\Config;
use App\Category;

class MilanoTableSeeder extends Seeder
{
    public function run()
    {
        if (Config::where('name', 'instance_city')->first() == null) {
            $c = new Config();
            $c->name = 'instance_city';
            $c->value = 'Milano';
            $c->save();
        }

        if (Config::where('name', 'other_instance_cities')->first() == null) {
            $c = new Config();
            $c->name = 'other_instance_cities';
            $c->value = '[{"name":"Torino", "url":"https://celocelo.it/"}, {"name":"Val Susa", "url":"https://valsusa.celocelo.it/"}]';
            $c->save();
        }

        if (Config::where('name', 'powered_by')->first() == null) {
            $c = new Config();
            $c->name = 'powered_by';
            $c->value = 'Milano 2035';
            $c->save();
        }

        if (Config::where('name', 'owner_address')->first() == null) {
            $c = new Config();
            $c->name = 'owner_address';
            $c->value = 'via Morgari 14, 10125, Torino';
            $c->save();
        }

        if (Config::where('name', 'credits')->first() == null) {
            $c = new Config();
            $c->name = 'credits';
            $c->value = sprintf('<p>Un progetto di<br/><img src="%s" alt="Milano 2035"></p><p>Con il sostegno di<br/><img src="%s" alt="Welfare in Azione"><img src="%s" alt="Fondazione Cariplo">', url('images/milano2035.png'), url('welfareinazione.jpg'), url('images/fondazione_cariplo.png'));
            $c->save();
        }

        if (Config::where('name', 'full_credits')->first() == null) {
            $c = new Config();
            $c->name = 'full_credits';
            $c->value = '<p class="intro">Progetto</p><p>"Milano 2035 - Coalizione per l\'Abitare Giovanile" è uno degli otto interventi finanziati dal IV bando "Welfare di comunità" di Fondazione Cariplo. La piattaforma celocelo Milano2035 è realizzata in collaborazione con l’associazione Agenzia per lo sviluppo locale di San Salvario ONLUS</p><p class="intro">Partner</p><p>Fondazione DAR Cesare Scarponi ONLUS (capofila), La Cordata s.c.s., Fondazione Attilio e Teresa Cassoni, Associazione MeglioMilano, Genera s.c.s. ONLUS, Cooperativa Sociale Tuttinsieme, ACLI provinciali di Milano, Associazione Collaboriamo, Associazione Housing lab, Fondazione San Carlo ONLUS, Associazione CIESSEVI, Officina dell’Abitare coop. Sociale, Università degli Studi di Milano Bicocca - Dipartimento di Sociologia e Ricerca Sociale, Politecnico di Milano - Dipartimento Dastu, Comune di Cinisello Balsamo.</p>';
            $c->save();
        }

        if (Config::where('name', 'video_link')->first() == null) {
            $c = new Config();
            $c->name = 'video_link';
            $c->value = 'https://www.youtube-nocookie.com/embed/pGZURLZQZ7w?rel=0&amp;controls=0&amp;showinfo=0';
            $c->save();
        }

        if (Config::where('name', 'players_map_coordinates')->first() == null) {
            $c = new Config();
            $c->name = 'players_map_coordinates';
            $c->value = '9.3284, 45.4604';
            $c->save();
        }

        if (Config::where('name', 'players_map_zoom')->first() == null) {
            $c = new Config();
            $c->name = 'players_map_zoom';
            $c->value = '12';
            $c->save();
        }

        if (Config::where('name', 'contact_main')->first() == null) {
            $c = new Config();
            $c->name = 'contact_main';
            $c->value = 'Ass. Agenzia per lo sviluppo di San Salvario onlus
c/o Casa del Quartiere San Salvario';
            $c->save();
        }

        if (Config::where('name', 'contact_contents')->first() == null) {
            $c = new Config();
            $c->name = 'contact_contents';
            $c->value = 'via Morgari 14 - 10125 Torino
segreteria@agenzia.sansalvario.org
T 011 6686772';
            $c->save();
        }

        if (Config::where('name', 'contact_map_coordinates')->first() == null) {
            $c = new Config();
            $c->name = 'contact_map_coordinates';
            $c->value = '7.67824, 45.05408';
            $c->save();
        }

        if (Config::where('name', 'contact_map_title')->first() == null) {
            $c = new Config();
            $c->name = 'contact_map_title';
            $c->value = 'Milano 2035';
            $c->save();
        }

        $categories = [
            'object' => [
                'Casa' => [
                    'Arredamento',
                    'Biancheria',
                    'Elettrodomestici',
                    'Elettronica',
                    'Stoviglie',
                    'Utensili'
                ],
            ],
            'service' => [
                'Abitare Collaborativo' => [
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
                    'Altro'
                ]
            ]
        ];

        $managed = [];

        foreach($categories as $type => $contents) {
            foreach($contents as $primary => $subs) {
                $master = Category::where('name', $primary)->first();
                if (is_null($master)) {
                    $master = new Category();
            		$master->name = $primary;
            		$master->parent_id = 0;
                    $master->type = $type;
            		$master->save();
                }

                $managed[] = $primary;

                foreach ($subs as $s) {
                    $cat = Category::where('name', $s)->first();
                    if (is_null($cat)) {
                        $cat = new Category();
                		$cat->name = $s;
                    }

                    $cat->parent_id = $master->id;
                    $master->type = $type;
                    $cat->save();

                    $managed[] = $s;
                }
            }
        }

        Category::whereNotIn('name', $managed)->delete();
    }
}
