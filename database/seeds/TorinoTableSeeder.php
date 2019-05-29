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

        if (Config::where('name', 'owner_address')->first() == null) {
            $c = new Config();
            $c->name = 'powered_by';
            $c->value = 'via Morgari 14, 10125, Torino';
            $c->save();
        }

        if (Config::where('name', 'credits')->first() == null) {
            $c = new Config();
            $c->name = 'credits';
            $c->value = sprintf('<p>Un progetto di<br/><img src="%s" alt="Agenzia per lo Sviluppo Locale di San Salvario"></p><p>Con il sostegno di<br/><img src="%s" alt="Compagnia di San Paolo">&nbsp;&nbsp;&nbsp;<img src="%s" alt="Iren"></p>', url('images/agenziasansalvario.jpg'), url('images/csp.png'), url('images/iren.jpg'));
            $c->save();
        }

        if (Config::where('name', 'full_credits')->first() == null) {
            $c = new Config();
            $c->name = 'full_credits';
            $c->value = '<p class="intro">Un progetto di</p><p>Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS</p><p class="intro">Partner</p><p>Ufficio Pio della Compagnia di San Paolo, Città di Torino - Circoscrizione 8, Città di Torino- Assessorato alle Politiche Sociali, Ass. Asai, Oratorio San Luigi, Ass. Opportunanda, Ass. Mondo di Joele, Ass. Manzoni People, Parrocchia SS.Pietro e Paolo, Coop. Soc. Accomazzi, Ass. Manamanà, Ass. Officina Informatica Libera, Coop. Soc. Triciclo, SPI CGIL Lega 8, Società Cooperativa Sociale Lancillotto, Centro di Ascolto della Parrocchia Patrocinio di San Giuseppe, Centro di Ascolto della Parrocchia Assunzione di Maria Vergine - Lingotto Torino, Commissione Carità del Consiglio Pastorale della Parrocchia Immacolata Concezione e San Giovanni Battista, Istituto Comprensivo "Sandro Pertini", Associazione Articolo 47.<br><br>Il progetto è sostenuto dalla Compagnia di San Paolo nell’ambito del Bando Fatto per Bene e dal Comitato Territoriale di Torino di Iren.</p><p class="intro">Con il patrocinio di</p><p><img src="/images/circ2.jpg"></p>';
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

        if (Config::where('name', 'food_full_credits')->first() == null) {
            $c = new Config();
            $c->name = 'food_full_credits';
            $c->value = sprintf('<p class="intro">Un progetto di</p><p>Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS, Equoevento ONLUS</p><p class="intro">In collaborazione con</p><p>Stranaidea Impresa Sociale ONLUS<br><br>Il progetto è sostenuto dalla Compagnia di San Paolo nell’ambito del Bando Fatto per Bene<br><br></p><img src="%s" alt="Agenzia per lo Sviluppo Locale di San Salvario ONLUS"><img src="%s" alt="Equoevento ONLUS"><img src="%s" alt="Stradaidea Impresa Sociale ONLUS"><img src="%s" alt="Compagnia di San Paolo">', url('images/agenziasansalvario.jpg'), url('images/equoevento.jpg'), url('images/stranaidea.jpg'), url('images/csp.png'));
            $c->save();
        }
    }
}
