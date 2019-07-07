<?php

use Illuminate\Database\Seeder;

use App\Config;

class TorinoTableSeeder extends Seeder
{
    public function run()
    {
        if (Config::where('name', 'facebook_link')->first() == null) {
            $c = new Config();
            $c->name = 'facebook_link';
            $c->value = 'https://www.facebook.com/celocelo-190331531485606/';
            $c->save();
        }

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

        if (Config::where('name', 'project_description')->first() == null) {
            $c = new Config();
            $c->name = 'project_description';
            $c->value = '<div class="col-md-6 right-p">
                <p>
                    Il progetto prevede un sistema di reperimento e distribuzione di beni di prossimità di varia
                    natura, basato su una rete locale di enti no profit e su una piattaforma informatica che renda
                    possibile l\'incrocio della domanda/offerta di beni e servizi di prima necessità, riducendo al
                    minimo l\'impegno e i costi di natura logistica, in particolare per quanto concerne lo stoccaggio,
                    l\'immagazzinamento e la distribuzione centralizzata.
                </p>
                <p>
                    I beneficiari diretti delle donazioni sono persone e famiglie svantaggiate, sia in condizione di
                    marginalità cronica, sia in condizione di povertà grigia derivante da eventi traumatici anche
                    recenti, come la perdita di lavoro, la separazione, la malattia.
                </p>
            </div>
            <div class="col-md-6 left-p">
                <p>
                    Sulla piattaforma tutti possono donare beni materiali, i commercianti possono donare fondi di
                    magazzino o altri beni in eccesso, i professionisti possono offrire gratuitamente servizi nei
                    settori della salute e dell\'abitare, le associazioni culturali possono offrire accessi gratuiti a
                    corsi, spettacoli e laboratori.
                </p>
                <p>
                    Gli operatori accreditati ad accedere alla piattaforma fanno parte di una rete di organizzazioni
                    che operano a contatto con persone e famiglie in difficoltà. Si tratta sia di organizzazioni che
                    gestiscono servizi e progetti in ambito socio assistenziale, sia organizzazioni che, pur non
                    avendo una mission esplicitamente sociale, entrano spesso in contatto con persone e famiglie in
                    difficoltà. Sono accreditati all’uso della piattaforma anche operatori dei servizi sociali
                    pubblici.
                </p>
                <p>
                    Per maggiori dettagli sul funzionamento visita <a href="/come-funziona">questa pagina</a>.
                </p>
            </div>';
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
            $c->value = sprintf('<p class="intro">Un progetto di</p><p>Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS, Equoevento ONLUS</p><p class="intro"><br>In collaborazione con</p><p>Stranaidea Impresa Sociale ONLUS</p><img src="%s" alt="Agenzia per lo Sviluppo Locale di San Salvario ONLUS"><img src="%s" alt="Equoevento ONLUS"><img src="%s" alt="Stradaidea Impresa Sociale ONLUS"><p class="intro"><br><br>Con il sostegno di</p><img src="%s" alt="Compagnia di San Paolo"><p><br>nell\'ambito del bando "Fatto per Bene 2018"</p>', url('images/agenziasansalvario.jpg'), url('images/equoevento.jpg'), url('images/stranaidea.jpg'), url('images/csp.png'));
            $c->save();
        }
    }
}
