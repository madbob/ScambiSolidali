<?php

namespace Database\Seeders;

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

        if (Config::where('name', 'explicit_zones')->first() == null) {
            $c = new Config();
            $c->name = 'explicit_zones';
            $c->value = 'true';
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
            $c->value = sprintf('<p>Un progetto di<br/><img src="%s"><img src="%s"><img src="%s"><img src="%s"><img src="%s"></p>
            <p>In partnership con<br/><img style="max-width:220px" src="%s"><img src="%s"></p>
            <p>Con il sostegno di<br/><img src="%s"><img src="%s"><img src="%s"><img src="%s"><img src="%s"><img src="%s"><img src="%s"></p>',
            url('images/trentinosolidale.png'), url('images/caritas_trento.png'), url('images/cs4.png'), url('images/rotteinverse.png'), url('images/cittadini_attivi.png'),
            url('images/celocelo_trentino.png'), url('images/agenziasansalvario.jpg'),
            url('images/itasolidale.png'), url('images/ministero_lavoro.jpg'), url('images/provincia_trento.png'), url('images/svolta.png'), url('images/fondazione_volontariato_sociale.png'), url('images/csv_trento.png'), url('images/caritro.png'));
            $c->save();
        }

        if (Config::where('name', 'video_link')->first() == null) {
            $c = new Config();
            $c->name = 'video_link';
            $c->value = 'https://www.youtube-nocookie.com/embed/39SihdTfEQc?rel=0&amp;controls=0&amp;showinfo=0';
            $c->save();
        }

        if (Config::where('name', 'project_page')->first() == null) {
            $c = new Config();
            $c->name = 'project_page';
            $c->value = '<div class="col-md-12">
                <p>
                    Evitare lo spreco, promuovere e facilitare il riuso, diffondere la solidarietà verso chi è in condizioni di bisogno:
                    sono questi gli obiettivi di DONOTRENTINO.
                </p>
                <p>
                    Ci rivolgiamo a cittadini, organizzazioni, Pubbliche Amministrazioni affinché facciano la scelta consapevole di donare beni
                    in disuso che possono essere invece ben riutilizzati da altri.
                </p>
                <p>
                    I beneficiari finali di queste donazioni sono persone e famiglie svantaggiate, in condizione di marginalità o di difficoltà
                    temporanea derivante da eventi traumatici, come la perdita del lavoro o di una attività in proprio, la separazione, la malattia.
                </p>
                <p>
                    Come funziona DONOTRENTINO? Se scegli di donare hai a disposizione una piattaforma informatica, aperta e di facile uso,
                    che ti consente di offrire beni, tempo e competenze. I cittadini possono donare beni di uso quotidiano,
                    le imprese loro fondi di magazzino o altri beni in eccesso, i professionisti ore per servizi nei settori della salute o
                    dell\'abitare, associazioni culturali possono offrire accesso gratuito a corsi, spettacoli, laboratori.
                </p>
                <p>
                    Chi si occupa del tuo dono? L\'assegnazione di ciò che hai donato alla persona o famiglia bisognosa è curata da associazioni ed enti,
                    appositamente accreditati da DONOTRENTINO, che operano da tempo a diretto contatto con persone e famiglie in difficoltà e che,
                    grazie alla loro dislocazione sul territorio Trentino, facilitano la donazione e partecipano agli eventuali costi di trasporto/smontaggio/montaggio.
                </p>
                <p>
                    La rete solidale di DONOTRENTINO è aperta a tutti i soggetti accreditati – associazioni, cooperative, Servizi sociali e
                    delle politiche abitative di Comunità di Valle e Comuni – che operano specificatamente in ambito socio assistenziale o che,
                    grazie alle loro attività, entrano spesso in contatto con persone e famiglie in difficoltà. <a href="/come-funziona">Clicca qui per vedere COME FUNZIONA DONOTRENTINO</a>.
                </p>
            </div>
            <div class="col-md-12 credits">
                <p>Aderiamo all\'Economia Solidale Trentina come Welfare di Comunità</p><img style="height:50px" src="/images/economia_solidale_trentina.jpeg">
                <p class="intro">In partnership con</p><p><img style="height:50px" src="/images/celocelo_trentino.png">&nbsp;&nbsp;<img style="height:90px" src="/images/agenziasansalvario.jpg"></p>
                <p class="intro">Il progetto è stato sostenuto da</p><p>Ufficio sVOLta (spazio di progettazione creato da Fondazione Caritro, Fondazione Trentina per il Volontariato Sociale e Non Profit Network - CSV Trentino) nell’ambito del bando Intrecci Possibili 2020 - Volontariato che riparte.</p>
                <p class="intro">e da</p><p>ITASolidale e Ministero del Lavoro e delle Politiche Sociali</p>
            </div>';
            $c->save();
        }

        if (Config::where('name', 'contacts_page')->first() == null) {
            $c = new Config();
            $c->name = 'contacts_page';
            $c->value = '<div class="row">
                <div class="col-md-2">
                    <img src="' . url('images/trentinosolidale.png') . '">
                </div>

                <div class="col-md-10">
                    <p>
                        TRENTINOSOLIDALE ODV è un’ Organizzazione di Volontariato che dal 2001 opera in provincia e all’estero.
                        Con un apposito progetto, è dal 2009 che lotta contro lo spreco alimentare e, contemporaneamente, contro la povertà promuovendo e
                        realizzando azioni concrete come il recupero di alimenti (che altrimenti andrebbero persi) da supermercati e produttori locali e
                        distribuendoli, in una sola giornata, a più di 1.000 famiglie e alcuni centri di assistenza su tutto il territorio trentino.
                        Si lavora inoltre nella facilitazione del riuso dei beni e nella promozione della solidarietà.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <img src="' . url('images/cs4.png') . '">
                </div>

                <div class="col-md-10">
                    <p>
                        CS4 ONLUS viene fondata nel 1988 da un gruppo di genitori e amministratori della Comunità Alta Valsugana affinché le famiglie
                        potessero contare su un riferimento e un supporto nelle funzioni di cura e di educazione dei figli. Lo sguardo è rivolto
                        anche alla comunità come risorsa nella quale pure la persona che ha una disabilità possa realizzare il suo percorso di crescita e
                        di cittadinanza. Al suo interno sono attivi due centri del Riuso (Pergine C.R.E.A e RICO’), spazi dove CS4 e la comunità
                        si incontrano per condividere il valore della sostenibilità ambientale, l’integrazione, il senso civico, di solidarietà e promozione
                        di stili di vita sani.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <img src="' . url('images/caritas_trento.png') . '">
                </div>

                <div class="col-md-10">
                    <p>
                        Fondazione Comunità Solidale (FCS) è un ente religioso che opera in stretta sinergia con l\'Arcidiocesi di Trento e
                        l\'Ufficio Caritas Diocesana di Trento. "Accogliere, Ascoltare, Accompagnare": in queste tre parole, che sono il modo attraverso
                        il quale si coniuga l\'attenzione alla persona, si riassume ciò che FCS intende operare. FSC agisce anche sul piano educativo
                        nel campo del riuso e del riutilizzo di vestiario e, in parte, anche arredi domestici. Questo tipo di servizio vorrebbe diventare
                        occasione di promozione di percorsi educativi volti all\'essenzialità, ad un acquisto responsabile, a strategie e azioni
                        di solidarietà e di compartecipazione solidale.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <img src="' . url('images/rotteinverse.png') . '">
                </div>

                <div class="col-md-10">
                    <p>
                        ROTTE INVERSE APS nasce ufficialmente nel 2016 sulle basi del Movimento Decrescita Felice Alto Garda. Svolgiamo attività
                        di sensibilizzazione e riflessione sulla necessità di un cambiamento "di rotta" nel nostro stile di vita.
                        Ci occupiamo di pratiche responsabili per l\'Ambiente e la Comunità, come p.e. eventi (come "La Sarca Tutta Nuda");
                        corsi di orticultura sinergica e naturale; sensibilizzazione sull’economia circolare e di acquisto collettivo;
                        avvio di un centro riuso permanente ("RiCircolo"), dove è possibile prendere e donare oggettistica usata in buono stato e
                        dove si vuole far partire laboratori di upcycling e corsi di riparazione e autoproduzione.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
					<img src="' . url('images/cittadini_attivi.png') . '">
                </div>

                <div class="col-md-10">
                    <p>
                        GRUPPO DI CITTADINI ATTIVI: oltre agli enti del terzo settore, DONOTRENTINO è stato ideato e sviluppato anche da un piccolo
                        gruppo di cittadini attivi (volontari). Queste persone, con età, professioni e vissuti diversi, hanno apportato valori, idee e proposte,
                        non risparmiando tempo, energia e entusiasmo nello sviluppo di questo progetto.
                        <br><br><br>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="pagetitle">
                    <span>GESTIONE PROGETTO</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>
                        DONOTRENTINO ha come CABINA DI REGIA un gruppo di volontari significativamente motivati e rappresentativi di tutti i promotori di progetto.
                        Oltre al confronto continuo e la gestione quotidiana di attività di segreteria, la Regia si trova almeno una volta al mese per
                        discutere gli aspetti tecnici e strategici. Questo gruppo ha ideato e sviluppato il progetto e la piattaforma ed attualmente sceglie e
                        coordina gli strumenti per il suo potenziamento. Si lavora continuamente nell’elaborazione di documenti, individuazione di strategie future,
                        sviluppo di attività operative di segreteria e di contatto con istituzioni e associazioni. Ad oggi la regia conta anche dell’appoggio
                        di un operatore e di consulenti esterni, oltre ad alcuni volontari per attività sporadiche.
                        <br><br><br>
                    </p>
                </div>
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
                        <li>Registrati sul sito e inserisci l\'annuncio. Clicca <a href="/files/istruzione_donatore_donotrentino.pdf" class="txt-color">qui</a> per le istruzioni dettagliate.</li>
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
                    <p>Possono candidarsi tutti i soggetti previsti <a href="/files/regolamento_donotrentino.pdf">dal Regolamento</a> per l’accreditamento alla Piattaforma DONOTRENTINO.</p>
                    <p>Presenta domanda <a href="https://forms.gle/KTy2aQ3tLPE3wRYj8" target="_blank">compilando questo form</a>.</p>
                    <p><a href="/files/istruzione_operatore_donotrentino.pdf" class="txt-color">Qui</a> le istruzione dettagliate per gli operatori dei partner</p>
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
                    <p>
                        <a href="https://www.siwego.com/" target="_blank"><img src="/images/siwego.png" alt="Siwego"></a>
                    </p>
                    <p>
                        <a href="https://www.dicasaincosa.it/" target="_blank"><img src="/images/dicosaincosa.png" alt="Di Casa in Cosa"></a> (Dalla Viva Voce APS)
                    </p>
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
segreteria@donotrentino.it';
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
