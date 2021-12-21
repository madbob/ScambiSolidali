<?php

use Illuminate\Database\Seeder;

use App\Config;

class TorinoTableSeeder extends Seeder
{
    public function run()
    {
        if (Config::where('name', 'main_tagline')->first() == null) {
            $c = new Config();
            $c->name = 'main_tagline';
            $c->value = 'mettiamo in contatto chi opera nel sociale con chi ha qualcosa da regalare!';
            $c->save();
        }

        if (Config::where('name', 'homebox_title')->first() == null) {
            $c = new Config();
            $c->name = 'homebox_title';
            $c->value = sprintf("<strong>%s</strong> è una piattaforma che migliora la vita<br/>delle persone in difficoltà che ti stanno attorno. Ti permette di:", env('APP_NAME'));
            $c->save();
        }

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

        if (Config::where('name', 'explicit_zones')->first() == null) {
            $c = new Config();
            $c->name = 'explicit_zones';
            $c->value = 'false';
            $c->save();
        }

        if (Config::where('name', 'other_instance_cities')->first() == null) {
            $c = new Config();
            $c->name = 'other_instance_cities';
            $c->value = '[{"name":"Milano", "url":"https://milano.celocelo.it/"}, {"name":"Val Susa", "url":"https://valsusa.celocelo.it/"}]';
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

        if (Config::where('name', 'video_link')->first() == null) {
            $c = new Config();
            $c->name = 'video_link';
            $c->value = 'https://www.youtube-nocookie.com/embed/pGZURLZQZ7w?rel=0&amp;controls=0&amp;showinfo=0';
            $c->save();
        }

        if (Config::where('name', 'project_page')->first() == null) {
            $c = new Config();
            $c->name = 'project_page';
            $c->value = sprintf('<div class="col-md-3">
                <div class="common-card">
                    <div class="card-main image-frame" style="background-image: url(%s)">
                        &nbsp;
                    </div>
                    <div class="card-footer vert-align">
                        <p>
                            %s
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <div class="col-md-6 right-p">
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
                </div>
                <div class="col-md-6 right-p">
                    <p class="border-bottom">
                        &nbsp;
                    </p>
                </div>
                <div class="col-md-6 left-p">
                    <p class="border-bottom">
                        &nbsp;
                    </p>
                </div>
                <div class="col-md-12 credits">
                    <p class="intro">Un progetto di</p><p>Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS</p><p class="intro">Partner</p><p>Ufficio Pio della Compagnia di San Paolo, Città di Torino - Circoscrizione 8, Città di Torino- Assessorato alle Politiche Sociali, Ass. Asai, Oratorio San Luigi, Ass. Opportunanda, Ass. Mondo di Joele, Ass. Manzoni People, Parrocchia SS.Pietro e Paolo, Coop. Soc. Accomazzi, Ass. Manamanà, Ass. Officina Informatica Libera, Coop. Soc. Triciclo, SPI CGIL Lega 8, Società Cooperativa Sociale Lancillotto, Centro di Ascolto della Parrocchia Patrocinio di San Giuseppe, Centro di Ascolto della Parrocchia Assunzione di Maria Vergine - Lingotto Torino, Commissione Carità del Consiglio Pastorale della Parrocchia Immacolata Concezione e San Giovanni Battista, Istituto Comprensivo "Sandro Pertini", Associazione Articolo 47.<br><br>Il progetto è sostenuto dalla Compagnia di San Paolo nell’ambito del Bando Fatto per Bene e dal Comitato Territoriale di Torino di Iren.</p><p class="intro">Con il patrocinio di</p><p><img src="/images/circ2.jpg"></p>
                </div>
            </div>', url('images/categories/casa_elettrodomestici.svg'), env('APP_NAME'));

            $c->save();
        }

        if (Config::where('name', 'working_description')->first() == null) {
            $c = new Config();
            $c->name = 'working_description';
            $c->value = '<div class="row primary-1">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>SEI UN PRIVATO?</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <h4>Hai un oggetto che non usi più<br/>o vuoi donare un po\' del tuo tempo?</h4>

                    <p><a class="arrowlink" href="' . url('celo') . '">vai su CELO!</a></p>
                    <p>Registrati sul sito, scegli la categoria, descrivi il tuo oggetto, aggiungi delle foto e premi Invio! Oppure descrivi le tue competenze e la tua disponibilità di tempo!<br/></p>
                    <p><a class="arrowlink" href="' . url('manca') . '">vai su MANCA!</a></p>
                    <p>Consulta la bacheca dei nostri appelli, scoprirai  cosa stiamo cercando.</p>
                    <p>Tutti gli oggetti saranno destinati  a persone in difficoltà economica individuate dalle <a href="' . url('giocatori') . '">organizzazioni aderenti</a>.</p>
                </div>
            </div>

            <hr class="black">

            <div class="row primary-2">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>SEI UN OPERATORE SOCIALE?</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <h4>Vuoi aderire al progetto?</h4>

                    <p>Se vuoi aderire al progetto ed essere accreditato all’uso della piattaforma scrivi a <a href="mailto:' . env('MAIL_FROM_ADDRESS') . '">'. env('MAIL_FROM_ADDRESS') . '</a>.</p>
                    <p>Possono aderire enti no profit che operano a favore di persone in difficoltà.</p>
                </div>
            </div>

            <hr class="black">

            <div class="row primary-1">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>COME AVVIENE LA DONAZIONE?</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <h4>Qui trovi le istruzioni</h4>

                    <ol>
                        <li>Registrati sul sito</li>
                        <li>Inserisci il tuo annuncio</li>
                        <li>Aspetta di essere contattato</li>
                        <li>Prendi accordi per il trasporto</li>
                    </ol>

                    <p>I beni e il tempo donati andranno a favore di persone in difficoltà, potrai conoscere l’esito della donazione tramite l\'Associazione che l\'ha gestita.</p>
                </div>
            </div>

            <hr class="black">

            <div class="row primary-2">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>TRASPORTO E SMONTAGGIO</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <h4>Trasporto</h4>

                    <p>Ecco le possibili opzioni:</p>
                    <ul>
                        <li>il donatore è disponibile a consegnare il bene al beneficiario dopo aver preso accordi con l’Ente accreditato di riferimento</li>
                        <li>l’Ente accreditato provvede al ritiro e alla consegna del bene</li>
                        <li>il beneficiario provvede in modo autonomo al ritiro del bene previ accordi tra donatore e l’Ente accreditato</li>
                        <li>il beneficiario o l’Ente accreditato sono in grado di sostenere la spesa di trasporto e possono chiedere un preventivo a un fornitore di loro fiducia oppure alla Cooperativa La Fonte, partner del nostro progetto (sotto i dettagli)</li>
                        <li>nel caso di impossibilità ad effettuare il trasporto da parte dell’Ente accreditato o in caso  di gravi difficoltà economiche del beneficiario, il progetto celocelo può contribuire a sostenere le spese del trasporto richiesto, l’operatore dovrà richiedere il trasporto quando assegna il bene tramite il sito</li>
                    </ul>

                    <h4>Smontaggio</h4>

                    <p>Il progetto non sostiene le spese di smontaggio e montaggio.</p>
                    <p>Chiediamo al donatore di far trovare i mobili smontati e a chi riceve di provvedere al montaggio.</p>
                    <p>Nel caso di impossibilità a provvedere allo smontaggio e al montaggio di seguito trovate i contatti e le tariffe dei nostri fornitori di fiducia (in caso di gravi difficoltà il progetto celocelo può contribuire a sostenerne le spese).</p>
                    <p>La Fonte Solidale Cooperativa Sociale<br>corso Vinzaglio 2, Torino</p>
                    <p>Per informazioni  e preventivi : lafonte.solidale@gmail.com<br>Tel. 351 2276924, Enzo Covito</p>
                    <p>Tariffe:<br>17 euro all\'ora a persona per la manodopera<br>90 centesimi al km per il trasporto</p>
                </div>
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
            $c->value = sprintf('<p class="intro">Un progetto di</p><p>Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS, Equoevento ONLUS</p><p class="intro"><br>In collaborazione con</p><p>Stranaidea Impresa Sociale ONLUS</p><img src="%s" alt="Agenzia per lo Sviluppo Locale di San Salvario ONLUS"><img src="%s" alt="Equoevento ONLUS"><img src="%s" alt="Stradaidea Impresa Sociale ONLUS"><p class="intro"><br><br>Con il sostegno di</p><img src="%s" alt="Compagnia di San Paolo"><img src="%s" alt="Iren"><p class="details"><br>nell\'ambito del bando "Fatto per Bene 2018"</p>', url('images/agenziasansalvario.jpg'), url('images/equoevento.jpg'), url('images/stranaidea.jpg'), url('images/csp.png'), url('images/iren.jpg'));
            $c->name = 'food_full_credits';
            $c->save();
        }
    }
}
