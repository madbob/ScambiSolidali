<?php

use Illuminate\Database\Seeder;

use App\Config;

class ValsusaTableSeeder extends Seeder
{
    public function run()
    {
        if (Config::where('name', 'instance_city')->first() == null) {
            $c = new Config();
            $c->name = 'instance_city';
            $c->value = 'Val Susa';
            $c->save();
        }

        if (Config::where('name', 'other_instance_cities')->first() == null) {
            $c = new Config();
            $c->name = 'other_instance_cities';
            $c->value = '[{"name":"Torino", "url":"https://celocelo.it/"}]';
            $c->save();
        }

        if (Config::where('name', 'powered_by')->first() == null) {
            $c = new Config();
            $c->name = 'powered_by';
            $c->value = 'Consorzio Intercomunale Socio-Assistenziale Val Susa';
            $c->save();
        }

        if (Config::where('name', 'owner_address')->first() == null) {
            $c = new Config();
            $c->name = 'owner_address';
            $c->value = 'piazza San Francesco 4, 10059, Susa (TO)';
            $c->save();
        }

        if (Config::where('name', 'credits')->first() == null) {
            $c = new Config();
            $c->name = 'credits';
            $c->value = sprintf('<span>Un progetto di<br/><img src="%s" alt="Agenzia per lo Sviluppo Locale di San Salvario"></span><span>In collaborazione con<br/><img src="%s" alt="Con.I.S.A."></span><span>Con il sostegno di<br/><img src="%s" alt="Compagnia di San Paolo" height="50px">', url('images/agenziasansalvario.jpg'), url('images/conisa.jpg'), url('images/csp.png'), url('images/iren.jpg'));
            $c->save();
        }

        if (Config::where('name', 'full_credits')->first() == null) {
            $c = new Config();
            $c->name = 'full_credits';
            $c->value = '<p class="intro">Un progetto di</p><p>Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS</p><p class="intro">Con la collaborazione di</p><p> Consorzio Intercomunale Socio-Assistenziale Val Susa</p><p class="intro">Partner</p><p>Il progetto è sostenuto dalla Compagnia di San Paolo nell’ambito del Bando Fatto per Bene.</p>';
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
            $c->value = '7.3126, 45.0997';
            $c->save();
        }

        if (Config::where('name', 'players_map_zoom')->first() == null) {
            $c = new Config();
            $c->name = 'players_map_zoom';
            $c->value = '10';
            $c->save();
        }

        if (Config::where('name', 'contact_main')->first() == null) {
            $c = new Config();
            $c->name = 'contact_main';
            $c->value = 'Consorzio Intercomunale Socio-Assistenziale
Valle di Susa';
            $c->save();
        }

        if (Config::where('name', 'contact_contents')->first() == null) {
            $c = new Config();
            $c->name = 'contact_contents';
            $c->value = 'piazza San Francesco 4 - 10059 Susa (TO)
celocelo@conisa.it
T 011 9311392';
            $c->save();
        }

        if (Config::where('name', 'contact_map_coordinates')->first() == null) {
            $c = new Config();
            $c->name = 'contact_map_coordinates';
            $c->value = '7.04585, 45.13409';
            $c->save();
        }

        if (Config::where('name', 'contact_map_title')->first() == null) {
            $c = new Config();
            $c->name = 'contact_map_title';
            $c->value = 'Con.I.S.A.';
            $c->save();
        }
    }
}
