<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Config;
use App\Category;

class MilanoTableSeeder extends Seeder
{
    public function run()
    {
        if (Config::where('name', 'main_tagline')->first() == null) {
            $c = new Config();
            $c->name = 'main_tagline';
            $c->value = 'mettiamo in contatto i giovani abitanti del progetto Milano 2035 con chi vuole donare beni per la casa!';
            $c->save();
        }

        if (Config::where('name', 'homebox_title')->first() == null) {
            $c = new Config();
            $c->name = 'homebox_title';
            $c->value = sprintf("<strong>%s</strong> è una piattaforma che supporta i giovani abitanti del progetto <a href=\"http://www.milano2035.it\">Milano 2035</a>. Ti permette di:", env('APP_NAME'));
            $c->save();
        }

        if (Config::where('name', 'facebook_link')->first() == null) {
            $c = new Config();
            $c->name = 'facebook_link';
            $c->value = 'https://www.facebook.com/Milano2035/';
            $c->save();
        }

        if (Config::where('name', 'instance_city')->first() == null) {
            $c = new Config();
            $c->name = 'instance_city';
            $c->value = 'Milano';
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
            $c->value = '';
            $c->save();
        }

        if (Config::where('name', 'credits')->first() == null) {
            $c = new Config();
            $c->name = 'credits';
            $c->value = sprintf('<p>Un progetto di<br/><img src="%s" alt="Agenzia per lo Sviluppo Locale di San Salvario"><img src="%s" alt="Milano 2035"></p><p>Con il sostegno di<br/><img src="%s" alt="Welfare in Azione"><img src="%s" alt="Fondazione Cariplo"></p><p><a href="http://www.milano2035.it">www.milano2035.it</a></p>', url('images/agenziasansalvario.jpg'), url('images/milano2035.png'), url('images/welfareinazione.jpg'), url('images/fondazione_cariplo.png'));
            $c->save();
        }

        if (Config::where('name', 'cover_link')->first() == null) {
            $c = new Config();
            $c->name = 'cover_link';
            $c->value = asset('images/cartolina_milano.png');
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
                    <div class="col-md-12">
                    <p>
                        La piattaforma gestisce il reperimento e la distribuzione di beni per la casa (arredamento ed
                        elettrodomestici) e lo scambio di tempo e competenze per attività che hanno a che fare con
                        l\'abitare collaborativo, tra donatori privati e beneficiari del progetto Milano2035 - Coalizione
                        per l\'Abitare Giovanile.
                    </p>
                    <p>
                        I beneficiari diretti delle donazioni di beni per la casa sono gli under 35 della community di
                        Milano2035, che ha l\'intento di incoraggiare e facilitare l\'autonomia abitativa dei giovani
                        abitanti abbattendo barriere economiche e logistiche e permettendo loro di arredare casa in
                        economia. Mentre tutti possono essere protagonisti dello scambio di tempo e competenze: Milano2035
                        infatti promuove l\'abitare collaborativo, basato da un lato sul riusare, riciclare, sistemare e
                        modificare gli arredi per diverse esigenze; dall’altro sulla condivisione di tempo e competenze
                        per svolgere assieme tutte quelle attività che hanno a che fare con i luoghi della vita quotidiana
                        (dall\'organizzare una cena condominiale al ricevere un pacco o accogliere una persone per conto
                        di un co-houser; dalle piccole riparazioni casalinghe alla cura degli spazi comuni; dal doposcuola
                        per i ragazzi della porta accanto all’accompagnare la nonna a fare la spesa...).
                    </p>
                    <p>
                        Dunque, sulla piattaforma: tutti possono donare beni per la casa, tempo e competenze per
                        l\'abitare collaborativo; tutti possono usufruire del tempo e delle competenze altrui, mentre solo
                        i giovani accreditati come beneficiari di <a href="http://www.milano2035.it">Milano 2035</a> possono usufruire dei beni donati
                        (direttamente oppure attraverso uno degli enti che promuovono il progetto).
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
                    <p class="intro">Progetto</p><p><a href="http://www.milano2035.it">"Milano 2035 - Coalizione per l\'Abitare Giovanile"</a> è uno degli otto interventi finanziati dal IV bando "Welfare di comunità" di Fondazione Cariplo. La piattaforma celocelo Milano2035 è realizzata in collaborazione con l’associazione Agenzia per lo sviluppo locale di San Salvario ONLUS</p><p class="intro">Partner</p><p>Fondazione DAR Cesare Scarponi ONLUS (capofila), La Cordata s.c.s., Fondazione Attilio e Teresa Cassoni, Associazione MeglioMilano, Genera s.c.s. ONLUS, Cooperativa Sociale Tuttinsieme, ACLI provinciali di Milano, Associazione Collaboriamo, Associazione Housing lab, Fondazione San Carlo ONLUS, Associazione CIESSEVI, Officina dell’Abitare coop. Sociale, Università degli Studi di Milano Bicocca - Dipartimento di Sociologia e Ricerca Sociale, Politecnico di Milano - Dipartimento Dastu, Comune di Cinisello Balsamo.</p>
                </div>
            </div>', url('images/categories/casa_elettrodomestici.svg'), env('APP_NAME'));
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

                    <p><a class="arrowlink" href="' . url('celo') . '">vai su CELO!</a></p>
                    <p>Registrati sul sito, scegli la categoria, descrivi il tuo oggetto, aggiungi delle foto e premi Invio! Oppure descrivi le tue competenze e la tua disponibilità di tempo!<br/></p>
                    <p><a class="arrowlink" href="' . url('manca') . '">vai su MANCA!</a></p>
                    <p>Consulta la bacheca dei nostri appelli, scoprirai cosa stiamo cercando.</p>
                    <p>Tutti i beni donati saranno destinati ai giovani under 35 beneficiari diretti del progetto <a href="http://www.milano2035.it">Milano 2035</a>. Tutte le attività di abitare collaborativo saranno realizzate da chiunque voglia aderire a <a href="http://www.milano2035.it">Milano 2035</a>.</p>
                </div>
            </div>

            <hr class="black">

            <div class="row primary-2">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>VUOI ADERIRE?</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <h4>Vuoi aderire al progetto?</h4>

                    <p>Se sei un giovane under 35 puoi accedere alla donazione di beni per la casa e alle attività di abitare collaborativo. Se hai più di 35 anni, puoi accedere alle attività di abitare collaborativo.</p>
                    <p>In entrambe i casi, devi essere registrato: in fase di registrazione richiedi l\'accreditamento come Giovane <a href="http://www.milano2035.it">Milano 2035</a>.</p>
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

                    <p>I beni donati andranno a favore dei giovani beneficiari del progetto <a href="http://www.milano2035.it">Milano 2035</a>. Le attività di abitare collaborativo andranno a favore di tutta la collettività. Potrai conoscere gli esiti delle donazioni attraverso i canali di <a href="http://www.milano2035.it">Milano 2035</a>.</p>
                </div>
            </div>

            <hr class="black">

            <div class="row primary-2">
                <div class="col-md-3">
                    <div class="button screaming-border"><span>TRASPORTO E SMONTAGGIO</span></div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <h4>Trasporto</h4>

                    <p>
                        In generale, il progetto Milano 2035 non sostiene le spese di trasporto, smontaggio e montaggio.
                    </p>
                    <p>
                        In caso di donazioni “importanti” (es. intere cucine, mobili di grosse dimensioni, ecc.) in assenza di un beneficiario, è possibile contattare touchpoint@milano2035.it per valutare assieme una collaborazione per il trasporto e la custodia dell\'arredo presso lo spazio di progetto Lab Barona.
                    </p>
                    <p>
                        Negli altri casi è possibile contattare un nostro fornitore di fiducia, che accorda condizioni favorevoli ai partecipanti al progetto:
                    </p>
                    <p>
                        Atef Mikhail Samuel<br>
                        Email mikhail_165@yahoo.it<br>
                        Cellulare 333425804
                    </p>
                    <p>
                        Per avere una valutazione dei costi, è necessario fornire ad Atef una descrizione degli articoli da trasportare, con relative misure, nonché il tragitto da effettuare.
                    </p>
                    <p>
                        Le tariffe base da cui si parte per il trasporto sono: 50 Euro per articoli di lunghezza massima 2 metri e peso complessivo massimo 100 chili; 50 centesimi a chilometro per tragitti superiori a 10 chilometri. Per eventuale smontaggio e/o montaggio: 15 Euro all’ora-uomo.
                    </p>
                    <p>
                        Milano 2035 declina qualsiasi responsabilità per il servizio di trasporto, smontaggio e montaggio eventualmente richiesti al fornitore, rimanendo comunque a disposizione per ricevere eventuali segnalazioni e/o per individuare soluzioni personalizzate a seconda delle condizioni del donatore e/o del beneficiario.
                    </p>
                </div>
            </div>';

            $c->save();
        }

        if (Config::where('name', 'players_map_coordinates')->first() == null) {
            $c = new Config();
            $c->name = 'players_map_coordinates';
            $c->value = '9.1835, 45.4710';
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
            $c->value = 'Milano 2035';
            $c->save();
        }

        if (Config::where('name', 'contact_contents')->first() == null) {
            $c = new Config();
            $c->name = 'contact_contents';
            $c->value = 'touchpoint@milano2035.it

Touch Point presso Off Campus San Siro,
Via Giacinto Gigante, di fronte al n. 5, Milano (MI)
tutti i lunedì dalle 14.30 alle 17.30

Touch Point presso Cofò
Via Carlo Martinelli, 23 Cinisello Balsamo (MI)
dalle 8.00 alle 20.00';
            $c->save();
        }

        if (Config::where('name', 'contact_map_coordinates')->first() == null) {
            $c = new Config();
            $c->name = 'contact_map_coordinates';
            $c->value = '9.13835, 45.47117';
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
