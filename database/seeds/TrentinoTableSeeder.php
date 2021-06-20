<?php

use Illuminate\Database\Seeder;

use App\Config;

class TrentinoTableSeeder extends Seeder
{
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
                'Storie a lieto fine' => 'Lieto fine',
                'Lieto fine' => '',
                'Vuoi scoprire che fine ha fatto il tuo frigo? Qui ti raccontiamo le storie di successo di' => 'Vuoi scoprire che fine ha fatto il tuo dono? Qui ti raccontiamo le storie di successo di',
                'Qui puoi inserire il tuo annuncio!<br/>Dicci cosa vuoi regalare e attendi la nostra risposta!' => 'Qui puoi inserire il tuo annuncio.<br/>Pubblica cosa vuoi donare e attendi di essere contattato.',
                "Guarda cosa ci manca!<br/>Ce l'hai?<br/>Rispondi alle nostre call, ti contatteremo appena possibile!" => "Controlla le necessità! Se ce l'hai, rispondi agli appelli e ti contatteremo presto!",
                'IL PROGETTO' => 'IL PROGETTO DONOTRENTINO',
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

        if (Config::where('name', 'main_tagline')->first() == null) {
            $c = new Config();
            $c->name = 'main_tagline';
            $c->value = 'mettiamo in contatto chi opera nel sociale con chi ha qualcosa da donare!';
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
            $c->value = 'https://www.facebook.com/DonoTrentino';
            $c->save();
        }

        if (Config::where('name', 'instagram_link')->first() == null) {
            $c = new Config();
            $c->name = 'instagram_link';
            $c->value = 'https://www.instagram.com/donotrentino/';
            $c->save();
        }

        if (Config::where('name', 'youtube_link')->first() == null) {
            $c = new Config();
            $c->name = 'youtube_link';
            $c->value = 'https://www.youtube.com/channel/UCBW6U2L6YJ6U47Cv5nF5DdQ';
            $c->save();
        }

        if (Config::where('name', 'instance_city')->first() == null) {
            $c = new Config();
            $c->name = 'instance_city';
            $c->value = 'Trentino';
            $c->save();
        }

        if (Config::where('name', 'other_instance_cities')->first() == null) {
            $c = new Config();
            $c->name = 'other_instance_cities';
            $c->value = '[]';
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
            $c->value = sprintf('<p>Un progetto di<br/><img src="%s"><img src="%s"><img src="%s"><img src="%s"></p>
            <p>In partnership con<br/><img style="max-width:220px" src="%s"><img src="%s"></p>
            <p>Con il sostegno di<br/><img src="%s"><img src="%s"><img src="%s"><img src="%s"></p>',
            url('images/trentinosolidale.png'), url('images/caritas_trento.png'), url('images/cs4.png'), url('images/rotteinverse.png'),
            url('images/celocelo_trentino.png'), url('images/agenziasansalvario.jpg'),
            url('images/svolta.png'), url('images/fondazione_volontariato_sociale.png'), url('images/csv_trento.png'), url('images/caritro.png'));
            $c->save();
        }

        if (Config::where('name', 'video_link')->first() == null) {
            $c = new Config();
            $c->name = 'video_link';
            $c->value = 'https://www.youtube-nocookie.com/embed/rAn71sY2Il0?rel=0&amp;controls=0&amp;showinfo=0';
            $c->save();
        }

        if (Config::where('name', 'project_page')->first() == null) {
            $c = new Config();
            $c->name = 'project_page';
            $c->value = '<div class="col-md-12">
                <p>
                    DONOTRENTINO si rivolge innanzitutto a cittadini, imprese e organizzazioni affinché facciano la scelta consapevole
                    di donare beni in disuso che possono essere invece ben riutilizzati da altri. Obiettivi: evitare lo spreco, promuovere e facilitare il
                    riuso, diffondere la solidarietà verso chi è in condizioni di bisogno.
                </p>
                <p>
                    I beneficiari finali di queste donazioni sono, infatti, persone e famiglie svantaggiate, in condizione di marginalità
                    cronica o di difficoltà temporanea derivante da eventi traumatici, come la perdita del lavoro o di una attività in
                    proprio, la separazione, la malattia.
                </p>
                <p>
                    Chi sceglie di donare ha così a disposizione una piattaforma informatica, aperta e di facile uso, che consente di offrire
                    beni, ma anche tempo e competenze. Cittadini possono donare beni di uso quotidiano, imprese loro fondi di
                    magazzino o altri beni in eccesso, professionisti ore per servizi nei settori della salute o dell\'abitare, associazioni
                    culturali possono offrire qualche accesso gratuito a corsi, spettacoli, laboratori.
                </p>
                <p>
                    L\'assegnazione mirata di quanto offerto a chi effettivamente ne ha bisogno è curata da associazioni ed enti,
                    appositamente accreditati da DONOTRENTINO, che operano da tempo a diretto contatto con persone e famiglie in
                    difficoltà e che, grazie alla loro ramificazione territoriale, possono altresì ridurre al minimo l\'impegno operativo
                    necessario e gli eventuali costi di smontaggio/montaggio e distribuzione.
                </p>
                <p>
                    La rete solidale è inizialmente costituita dai promotori di DONOTRENTINO, ma è aperta a tutti i soggetti accreditati –
                    associazioni, imprese, enti – che operano specificatamente in ambito socio assistenziale o che, pur svolgendo altre
                    attività, entrano spesso in contatto con persone e famiglie in difficoltà.
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
                <p class="intro">Progetto promosso da</p><p>TRENTINO SOLIDALE ODV, CS 4 ONLUS, CARITAS DIOCESANA, ROTTE INVERSE APS, GRUPPO DI CITTADINI ATTIVI</p>
                <p class="intro">In partnership con</p><p><img style="height:50px" src="/images/celocelo_trentino.png">&nbsp;&nbsp;<img style="height:90px" src="/images/agenziasansalvario.jpg"></p>
                <p class="intro">Il progetto è sostenuto da</p><p>Ufficio sVOLta (spazio di progettazione creato da Fondazione Caritro, Fondazione Trentina per il Volontariato Sociale e Non Profit Network - CSV Trentino) nell’ambito del bando Intrecci Possibili 2020 - Volontariato che riparte.</p>
            </div>';
            $c->save();
        }

        if (Config::where('name', 'working_description')->first() == null) {
            $c = new Config();
            $c->name = 'working_description';
            $c->value = '<div class="row primary-1">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>VUOI DONARE?</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <h4>Hai un oggetto che non usi più<br/>o vuoi donare un po\' del tuo tempo?</h4>

                    <p><a class="arrowlink" href="' . url('celo') . '">vai su DONO!</a></p>
                    <p>Registrati sul sito, scegli la categoria, descrivi il tuo oggetto, aggiungi delle foto e premi Invio! Oppure descrivi le tue competenze e la tua disponibilità di tempo e premi Invio!<br/></p>
                    <p><a class="arrowlink" href="' . url('manca') . '">vai su CERCO!</a></p>
                    <p>Consulta la bacheca delle necessità e scoprirai  cosa stiamo cercando.</p>
                    <p>Tutti gli oggetti saranno destinati a persone in difficoltà individuate dai Soggetti accreditati aderenti alla rete.</p>
                </div>
            </div>

            <hr class="black">

            <div class="row primary-2">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>COME SI DONA?</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <ol>
                        <li>Registrati sul sito e inserisci l\'annuncio.</li>
                        <li>Aspetta di essere contattato</li>
                        <li>Concorda direttamente con il Soggetto accreditato i tempi e le modalità di ritiro e di consegna del bene.</li>
                    </ol>

                    <p>I beni e il tempo donati andranno a favore di persone in difficoltà, potrai conoscere il LIETO FINE della tua donazione <a href="/numeri">tramite il Soggetto che l\'ha gestita</a>.</p>
                </div>
            </div>

            <hr class="black">

            <div class="row primary-1">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>VUOI DIVENTARE UN PARTNER DELLA RETE SOLIDALE DI DONOTRENTINO?</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <p>Presenta domanda <a href="https://forms.gle/KTy2aQ3tLPE3wRYj8">compilando questo form</a>.</p>
                    <p>Possono candidarsi tutti i soggetti previsti <a href="/files/regolamento_donotrentino.pdf">dal Regolamento</a> per l’accreditamento alla Piattaforma DONOTRENTINO.</p>
                </div>
            </div>

            <hr class="black">

            <div class="row primary-2">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>COME FUNZIONA LA CONSEGNA DEI BENI?</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <p>
                        Di regola, i donatori consegnano il bene al Soggetto accreditato o, su indicazione di questo, al beneficiario.
                    </p>
                    <p>
                        Eventuali mezzi e oneri per lo smontaggio e/o il trasporto e/o il montaggio del bene sono a carico, rispettivamente, del donatore, del Soggetto accreditato e del beneficiario del bene.
                    </p>
                    <p>
                        Il Soggetto accreditato può concordare con le parti, o con altri Soggetti accreditati, modalità diverse per la ripartizione degli oneri.
                    </p>
                    <p>
                        DONOTRENTINO segnala imprese sociali che offrono servizi di smontaggio, di trasporto, e di montaggio di beni a prezzi concordati:
                    </p>
                    <ul>
                        <li><a href="https://www.siwego.com/">www.siwego.com</a></li>
                        <li><a href="https://www.dicasaincosa.it/">www.dicasaincosa.it</a> (Dalla Viva Voce APS)</li>
                        <li>lista in fase di aggiornamento</li>
                    </ul>
                </div>
            </div>';

            $c->save();
        }

        if (Config::where('name', 'players_map_coordinates')->first() == null) {
            $c = new Config();
            $c->name = 'players_map_coordinates';
            $c->value = '11.1255, 46.0651';
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
            $c->value = 'TRENTINOSOLIDALE';
            $c->save();
        }

        if (Config::where('name', 'contact_contents')->first() == null) {
            $c = new Config();
            $c->name = 'contact_contents';
            $c->value = 'Viale Bolognini 98 - Trento
segreteria@donotrentino.it
T 3312717656';
            $c->save();
        }

        if (Config::where('name', 'contact_map_coordinates')->first() == null) {
            $c = new Config();
            $c->name = 'contact_map_coordinates';
            $c->value = '11.13669, 46.06510';
            $c->save();
        }

        if (Config::where('name', 'contact_map_title')->first() == null) {
            $c = new Config();
            $c->name = 'contact_map_title';
            $c->value = 'TRENTINOSOLIDALE';
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
