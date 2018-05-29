<?php

use Illuminate\Database\Seeder;

use App\Config;

class TorinoTableSeeder extends Seeder
{
    public function run()
    {
        if (Config::where('name', 'instance_city')->first() == null) {
            $c = new Config();
            $c->name = 'instance_city';
            $c->value = 'Torino';
            $c->save();
        }

        if (Config::where('name', 'other_instance_cities')->first() == null) {
            $c = new Config();
            $c->name = 'other_instance_cities';
            $c->value = '[{"name":"Val Susa", "url":"https://valsusa.celocelo.it/"}]';
            $c->save();
        }

        if (Config::where('name', 'powered_by')->first() == null) {
            $c = new Config();
            $c->name = 'powered_by';
            $c->value = 'Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS';
            $c->save();
        }

        if (Config::where('name', 'partners')->first() == null) {
            $c = new Config();
            $c->name = 'partners';
            $c->value = 'Ufficio Pio della Compagnia di San Paolo, Città di Torino - Circoscrizione 8, Città di Torino- Assessorato alle Politiche Sociali, Ass. Asai, Oratorio San Luigi, Ass. Opportunanda, Ass. Mondo di Joele, Ass. Manzoni People, Parrocchia SS.Pietro e Paolo, Coop. Soc. Accomazzi, Ass. Manamanà, Ass. Officina Informatica Libera, Coop. Soc. Triciclo, SPI CGIL Lega 8, Società Cooperativa Sociale Lancillotto, Centro di Ascolto della Parrocchia Patrocinio di San Giuseppe, Centro di Ascolto della Parrocchia Assunzione di Maria Vergine - Lingotto Torino, Commissione Carità del Consiglio Pastorale della Parrocchia Immacolata Concezione e San Giovanni Battista, Istituto Comprensivo "Sandro Pertini", Associazione Articolo 47.

Il progetto è sostenuto dalla Compagnia di San Paolo nell’ambito del Bando Fatto per Bene.';
            $c->save();
        }

        if (Config::where('name', 'patronages')->first() == null) {
            $c = new Config();
            $c->name = 'patronages';
            $c->value = '<img src="/images/circ2.jpg">';
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
            $c->value = '7.67824, 45.05408';
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
            $c->value = 'Casa del Quartiere';
            $c->save();
        }
    }
}
