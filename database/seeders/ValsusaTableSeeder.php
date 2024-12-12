<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Vite;

use App\Config;

class ValsusaTableSeeder extends Seeder
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
            $c->value = 'Val Susa';
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
            $c->value = '[{"name":"Torino", "url":"https://celocelo.it/"}, {"name":"Milano", "url":"https://milano.celocelo.it/"}]';
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
            $c->value = sprintf('<p>Un progetto di<br/><img src="%s" alt="Agenzia per lo Sviluppo Locale di San Salvario"></p><p>In collaborazione con<br/><img src="%s" alt="Con.I.S.A."></p><p>Con il sostegno di<br/><img src="%s" alt="Compagnia di San Paolo" height="50px"></p>', Vite::asset('resources/images/agenziasansalvario.jpg'), Vite::asset('resources/images/conisa.jpg'), Vite::asset('resources/images/csp.png'), Vite::asset('resources/images/iren.jpg'));
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
                <div class="row">
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
                        <p class="intro">Un progetto di</p><p>Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS</p><p class="intro">Con la collaborazione di</p><p> Consorzio Intercomunale Socio-Assistenziale Val Susa</p><p class="intro">Partner</p><p>Il progetto è sostenuto dalla Compagnia di San Paolo nell’ambito del Bando Fatto per Bene.</p>
                    </div>
                </div>
            </div>', Vite::asset('resources/images/categories/casa_elettrodomestici.svg'), env('APP_NAME'));
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

                    <p>Se vuoi aderire al progetto ed essere accreditato all’uso della piattaforma scrivi a <a href="mailto:' . env('MAIL_ADMIN') . '">'. env('MAIL_ADMIN') . '</a>.</p>
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
                    <p>Cooperativa La Fonte Onlus<br>Società Cooperativa Sociale<br>Via San Marchese 26/2 – 10078 Venaria Reale (To)
                    </p>
                    <p>Per informazioni  e preventivi : lafonteonlus16@gmail.com<br>Tel. 351 2276924, Enzo Covito
                    </p>
                    <p>Tariffe:<br>17 euro all\'ora a persona per la manodopera<br>80 centesimi al km per il trasporto (tenendo conto che la partenza è da Venaria)</p>
                </div>
            </div>';

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
            $c->value = '9';
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
