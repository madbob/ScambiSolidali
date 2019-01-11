@extends('layouts.app')

@section('title', 'Giocatori')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>INFORMATIVA SULLA PRIVACY</h1>

            <h3>TITOLARE</h3>
            <p>
                Il titolare del trattamento dei tuoi dati è {{ App\Config::getConf('powered_by') }}.
            </p>
            <p>
                Per ogni necessità puoi contattare il titolare all’indirizzo {{ App\Config::getConf('owner_address') }} o all'email {{ env('MAIL_FROM_ADDRESS') }}.
            </p>
            <p>
                Il titolare tratterà i tuoi dati con liceità e correttezza nel rispetto dei tuoi diritti ed in particolare della tua riservatezza ai sensi del Regolamento (UE) 2016/679 (di seguito “Regolamento”) e delle altre norme applicabili.
            </p>

            <h3>DATI</h3>

            <p>
                Il titolare tratterà i seguenti dati:
            </p>
            <p>
                <strong>Dati del profilo</strong> - Quando ti registri, aggiungi nuovi dati al tuo profilo, o modifichi quelli esistenti,  acquisiamo i tuoi dati personali (nome, indirizzo, e-mail, telefono, ecc.).
            </p>
            <p>
                <strong>Dati delle attività</strong> - Quando usi i nostri servizi, registriamo le tue attività.
            </p>
            <p>
                <strong>Dati di navigazione</strong> - Quando ti colleghi al nostro sistema, questo registra automaticamente le informazioni che il tuo dispositivo ci invia. Queste informazioni possono riguardare le operazioni svolte, l'indirizzo IP ed il MAC Address dai quali ti colleghi, il sistema operativo e la lingua del tuo dispositivo, la data e l’ora della tua richiesta, la tua posizione.
            </p>
            <p>
                <strong>Dati di contatto e comunicazioni</strong> - Quando ci invii i tuoi dati di contatto (email, ecc.) e un'email o un’altra comunicazione registriamo i tuoi dati di contatto e la comunicazione.
            </p>
            <p>
                <strong>Cookie</strong> - Quando utilizzi i nostri servizi possiamo inviare al tuo dispositivo uno o più cookie (piccoli file di testo contenente una stringa di caratteri alfanumerici):
            </p>
            <ul>
                <li>cookie tecnici, cioè di navigazione o sessione e strettamente necessari per il funzionamento del sito o per consentirti di usufruire dei contenuti e dei servizi da te richiesti;</li>
                <li>cookie di terze parti, cioè cookie di siti o di web server diversi da quello che ospita il nostro servizio, utilizzati, con il tuo consenso, per finalità proprie di dette parti terze.</li>
            </ul>

            <h3>FINALITÀ E BASE GIURIDICA DEL TRATTAMENTO</h3>

            <p>
                I tuoi dati verranno trattati con le seguenti finalità:
            </p>
            <ul>
                <li>fornirti i servizi ai sensi dell’articolo 6, paragrafo 1, lettera b), del Regolamento,</li>
                <li>valutare e migliorare i servizi e svilupparne di nuovi perseguendo questo legittimo interesse ai sensi dell’articolo 6, paragrafo 1, lettera f), del Regolamento,</li>
                <li>proteggere il funzionamento tecnico del sistema informatico perseguendo questo legittimo interesse ai sensi dell’articolo 6, paragrafo 1, lettera f), del Regolamento,</li>
                <li>adempiere ad obblighi di legge e/o ottemperare ad ordini provenienti da pubbliche autorità, inclusa l’autorità giudiziaria ai sensi dell’articolo 6, paragrafo 1, lettera c), del Regolamento,</li>
                <li>elaborare e diffondere analisi statistiche e rappresentazioni grafiche ma solo in forma aggregata ed anonima perseguendo questo legittimo interesse ai sensi dell’articolo 6, paragrafo 1, lettera f), del Regolamento.</li>
            </ul>

            <p>
                I tuoi dati di contatto saranno anche trattati anche per informarti sui servizi e sulle novità disponibili, perseguendo questo legittimo interesse ai sensi dell’articolo 6, paragrafo 1, lettera f), del Regolamento.
            </p>

            <h3>COMUNICAZIONE A TERZI</h3>
            <p>
                Il titolare potrà comunicare i tuoi dati a:
            </p>
            <ul>
                <li>soggetti terzi che collaborano con il titolare e provvedono a trattare fasi dei processi necessari al corretto espletamento delle sue attività,</li>
                <li>soggetti terzi per adempiere ad obblighi di legge o per ottemperare ad ordini provenienti da pubbliche autorità, inclusa l’autorità giudiziaria, e/o per tutelare i diritti del titolare o dei terzi ai sensi di legge.</li>
            </ul>

            <h3>PERIODO DI CONSERVAZIONE</h3>
            <p>
                I tuoi dati del profilo e i tuoi dati delle attività saranno conservati per il tempo massimo entro il quale potranno essere fatti valere diritti in relazione alle attività da te svolte utilizzando i servizi e (se prima di questa scadenza verranno fatti valere tali diritti da te o da terzi) per l‘eventuale tempo ulteriore necessario per utilizzare i dati per tutelare i diritti tuoi, del titolare e/o di terzi.
            </p>
            <p>
                I tuoi dati di contatto e le comunicazioni saranno conservati per il tempo necessario per far fronte alla tua richiesta e per l‘eventuale tempo ulteriore necessario per utilizzare i dati per tutelare i diritti tuoi, del titolare e/o di terzi.
            </p>
            <p>
                I tuoi dati di navigazione saranno conservati per massimo 1 anno.
            </p>

            <h3>DIRITTI</h3>
            <p>
                Ti ricordiamo che, ai sensi del Regolamento, hai diritto:
            </p>
            <ul>
                <li>di chiedere l’accesso ai tuoi dati personali ai sensi dell’articolo 15 del Regolamento,</li>
                <li>di chiedere la rettifica dei tuoi dati personali ai sensi dell’articolo 16 del Regolamento,</li>
                <li>di chiedere la cancellazione dei tuoi dati personali ai sensi dell’articolo 17 del Regolamento,</li>
                <li>di chiedere la limitazione del trattamento dei tuoi dati personali ai sensi dell’articolo 18 del Regolamento,</li>
                <li>di opporti al trattamento dei tuoi dati personali che sono trattati in base all’articolo  6, paragrafo 1, lettera f), del Regolamento ai sensi dell’articolo 21 del Regolamento ,</li>
                <li>alla portabilità dei tuoi dati personali ai sensi dell’articolo 20 del Regolamento,</li>
                <li>di proporre reclamo al Garante della Privacy italiano ai sensi dell’articolo 77 del Regolamento.</li>
            </ul>

            <h3>EFFETTI DELLA MANCATA COMUNICAZIONE AL TITOLARE</h3>
            <p>
                La comunicazione dei dati del profilo è un requisito necessario per concludere il contratto di registrazione e se non fornisci i dati del profilo non potrai registrarti.
            </p>

            <h3>INFORMAZIONI SUI COOKIE</h3>
            <p>
                Puoi controllare e/o sopprimere i cookie a piacimento – per saperne di più, consulta il sito http://www.allaboutcookies.org/.
            </p>
            <p>
                Puoi selezionare quali cookie autorizzare attraverso l’apposita procedura di seguito prevista, nonchè  cancellare i cookie già presenti sul tuo dispositivo e impostare la maggior parte dei browser in modo da bloccarne l'installazione.
            </p>
            <p>
                La maggior parte dei browser consente di:
            </p>
            <ul>
                <li>visualizzare i cookie presenti e cancellarli singolarmente,</li>
                <li>bloccare i cookie di terze parti,</li>
                <li>bloccare i cookie di particolari siti,</li>
                <li>bloccare l'installazione di tutti i cookie,</li>
                <li>cancellare tutti i cookie alla chiusura del browser.</li>
            </ul>
            <p>
                Per avere maggiori informazioni su come impostare le preferenze sull’uso dei cookie attraverso il tuo browser di navigazione, puoi consultare le relative istruzioni:
            </p>
            <ul>
                <li><a href="https://support.google.com/chrome/answer/95647?hl=it&topic=14666&ctx=topic">Chrome</a></li>
                <li><a href="https://support.mozilla.org/it/kb/Attivare%20e%20disattivare%20i%20cookie">Firefox</a></li>
                <li><a href="https://support.microsoft.com/en-us/help/17442/windows-internet-explorer-delete-manage-cookies">Internet Explorer</a></li>
                <li><a href="http://www.opera.com/help/tutorials/security/cookies/">Opera</a></li>
                <li><a href="http://support.apple.com/kb/PH17191?viewlocale=it_IT">Safari</a></li>
            </ul>
            <p>
                Se scegli di cancellare o non autorizzare
            </p>
            <ul>
                <li>i cookie tecnici, ti potrebbe essere impossibile utilizzare il sito, visionarne i contenuti ed usufruire dei relativi servizi,</li>
                <li>i cookie di terze parti alcuni servizi o determinate funzioni del sito potrebbero non esserti disponibili o non funzionare correttamente.</li>
            </ul>

            <h3>SERVIZI DI TERZI CHE INSTALLANO COOKIE</h3>
            <p>
                Utilizziamo i seguenti servizi che installano cookie per trattare i tuoi dati.
            </p>
            <p>
                <strong>Servizio Mapbox</strong> - Servizio di visualizzazione di mappe fornito da Mapbox inc. che utilizza cookie e permette a Mapbox inc. di raccogliere, conservare e trattare dati d'utilizzo del servizio secondo i termini della sua Privacy Policy (https://www.mapbox.com/privacy/).
            </p>

            <br><br><br>

            <h1>CONDIZIONI DI UTILIZZO</h1>

            <p>
                L’utilizzo del servizio Celocelo è regolato nei termini ed alle condizioni di seguito riportate.<br/>
                La fruizione del servizio e dei contenuti offerti da Celocelo comporta e presuppone l’integrale conoscenza e l’incondizionata accettazione delle clausole sottoelencate.
            </p>

            <h2>1 - INDIVIDUAZIONE DEL SERVIZIO E DEI CONTENUTI OFFERTI DA CELOCELO</h2>
            <p>
                {{ App\Config::getConf('powered_by') }}, con sede legale in {{ App\Config::getConf('owner_address') }} consente ai destinatari del proprio servizio di immettere, pubblicare e consultare gratuitamente annunci online di natura NON commerciale, al fine di facilitare la donazione di oggetti, competenze e tempo/lavoro volontario, destinate a persone in condizione di fragilità economica e sociale e/o ad organizzazioni non profit che operano nell’ambito della lotta all’esclusione sociale.
            </p>

            <h2>2 - OBBLIGHI E CONDOTTA DELL’UTENTE</h2>
            <p>
                Nell'ambito della presente sezione (Termini e condizioni d'uso) di Servizio con il termine "Utente/i" si intendono sia gli utenti navigatori che gli utenti inserzionisti.<br/>
                Il servizio potrà essere utilizzato dai maggiori di anni diciotto.<br/>
                L’eventuale utilizzo del servizio da parte dei minori, presuppone e sottintende l’autorizzazione dei genitori o di chi, sugli stessi, esercita la potestà o la tutela.<br/>
                Costoro si assumono, pertanto, la piena ed esclusiva responsabilità di qualsivoglia comportamento tenuto dal minore nell’accesso, nell’utilizzo e nella fruizione del servizio.<br/>
                L'Utente prende atto che Celocelo non effettuerà alcun controllo preventivo sul contenuto degli annunci immessi in rete, né svolgerà alcuna attività di intermediazione sugli eventuali accordi intercorrenti tra gli Utenti medesimi per il conferimento del bene donato.<br/>
                Questi ultimi si assumono, pertanto, la piena ed esclusiva responsabilità, verso Celocelo e verso i terzi, del comportamento tenuto.<br/>
                L'Utente fa uso del servizio messo a disposizione da Celocelo nella consapevolezza che quest'ultima non garantisce alcunché in ordine alla veridicità del contenuto degli annunci o al buon esito delle donazioni.<br/>
                Pubblicando il proprio annuncio su Celocelo l'utente autorizza {{ App\Config::getConf('powered_by') }} e le organizzazioni partner ad adoperarsi affinché il contenuto dell'annuncio venga reso visibile ed accessibile agli utenti della rete anche mediante successiva indicizzazione su motori di ricerca, mediante pubblicazione su altri siti e social network, al fine di promuovere con più efficacia le inserzioni dei propri utenti e facilitare la buona riuscita della donazione.
            </p>
            <p>
                L’Utente si impegna a non fruire dei servizi fornitigli da {{ App\Config::getConf('powered_by') }} e/o dal sito {{ env('APP_URL') }} in modo improprio o contrario alle disposizioni di Legge e regolamentari ed alle norme di Etica e di Buon uso dei servizi di rete.<br/>
                In particolare, l’Utente si impegna a non trasmettere, tramite Celocelo, materiale di natura offensiva, calunniosa, diffamatoria, pornografica, pedopornografica, volgare, oscena, blasfema, o comunque contraria ai principi dell’ordine pubblico e del buon costume.<br/>
                L'Utente è consapevole che l'indirizzo di posta elettronica reso noto su Celocelo potrà valere quale mezzo di comunicazione a distanza.<br/>
                L'Utente si impegna ad inoltrare annunci redatti in maniera accurata e veritiera, in particolare avendo riguardo alle caratteristiche pericolose/difettose degli oggetti in vendita, specialmente se in grado di procurare un pregiudizio a chi ne facesse uso.<br/>
                L'Utente dichiara di utilizzare il servizio offerto da Celocelo nella consapevolezza di poter incontrare link che possono rinviare a pagine web su cui Celocelo non ha alcun controllo e sul cui contenuto non assume alcuna responsabilità.<br/>
                L’Utente dichiara espressamente di astenersi da qualsivoglia discriminazione, diretta o indiretta, a causa della razza o dell’origine etnica degli individui, conformemente a quanto disposto in materia dal D.Lgs. n. 215/2003 e si impegna al rispetto delle Convenzioni poste a salvaguardia dei diritti umani.<br/>
                L’Utente si impegna a non pubblicare in rete, senza il consenso degli aventi diritto, inserzioni contenenti dati personali, sensibili e/o immagini di minori o di terzi, nonché materiale contenente virus o altri sistemi tesi a danneggiare il funzionamento del presente servizio o di qualsivoglia impianto deputato alla telediffusione.<br/>
                L'Utente si obbliga a non incoraggiare, commettere, favorire e/o agevolare in qualunque modo, mediante gli spazi messi a disposizione da Celocelo, azioni criminali e comportamenti illeciti in generale. L'Utente si obbliga a non pregiudicare l'uso ed il godimento del Servizio degli altri utenti.<br/>
                Mediante l’utilizzo delle risorse offerte da Celocelo, l'Utente si obbliga a non riprodurre, trascrivere, duplicare, distribuire, modificare o comunicare, senza averne diritto, materiale protetto dal diritto di autore ed a rispettare, in generale, qualsivoglia disposizione di cui alla L. n. 633/1941 e succ. modd. <br/>
                L’Utente si impegna a non richiedere la pubblicazione di annunci mendaci o aventi ad oggetto beni di provenienza illecita e/o, a qualsiasi titolo.<br/>
                L’Utente dichiara, altresì, di astenersi dall’inviare a qualunque terzo materiale informativo e/o pubblicitario non richiesto.<br/>
                Resta ferma l’insussistenza di qualsivoglia attività di intermediazione tra la domanda e l’offerta di lavoro da parte di Celocelo, di {{ App\Config::getConf('powered_by') }} e dei suoi partner.<br/>
                Celocelo si limita, infatti, ad offrire all’Utente uno spazio web per la pubblicazione dei propri annunci.<br/>
                L’Utente si impegna a non pubblicare inserzioni aventi ad oggetto l’offerta di prestazioni a carattere sessuale in cambio di denaro, o facenti riferimento ad organi sessuali, ovvero recanti immagini oscene e/o inappropriate.<br/>
                L’Utente sarà, pertanto, l’unico ed esclusivo responsabile del contenuto dei propri argomenti di discussione, i quali costituiscono espressione di libera manifestazione del pensiero, costituzionalmente tutelata, e dovranno svolgersi nel pieno rispetto dei limiti di Legge.<br/>
                L'Utente dichiara in particolare di usufruire del servizio messo a disposizione da Celocelo SENZA ALCUNA FINALITA’ COMMERCIALE. Beni e servizi trattati da Celocelo non avranno MAI essere oggetto di transazione commerciale o comportare forme di pagamento di corrispettivo anche non monetario.
            </p>

            <h2>3 – ESONERO DA RESPONSABILITA’ E CLAUSOLA DI MANLEVA</h2>
            <p>
                L’Utente, quale necessaria conseguenza della propria piena ed esclusiva responsabilità eventualmente derivante dalla violazione di Leggi, regolamenti e delle presenti condizioni generali, dichiara espressamente di esonerare Celocelo da qualsivoglia responsabilità, civile e penale, riconoscendone, fin d’ora, il difetto di legittimazione passiva in giudizio.<br/>
                In particolare, l’Utente si obbliga a manlevare Celocelo, sostanzialmente e processualmente, da qualsiasi pregiudizio, perdita, danno, responsabilità, costo, onere o spesa, incluse le spese legali, derivanti da pretese o da azioni avanzate da terzi, in qualunque sede ed a qualunque titolo, in conseguenza di annunci od opinioni immessi in rete dall’Utente mediante l’utilizzo improprio delle risorse offerte da Celocelo e dalle interazioni e transazioni di beni e servizi ad esso conseguenti.
            </p>

            <h2>4 – DIRITTI RISERVATI</h2>
            <p>
                Celocelo è titolare di tutti i servizi ed i contenuti messi a disposizione dell’Utente tramite il proprio sito web.<br/>
                E’, pertanto, vietata la riproduzione e/o l’utilizzazione, integrale o parziale, a titolo gratuito od o­neroso, di qualsivoglia risorsa del sito, della vesta grafica, di simboli, marchi, loghi o segni distintivi in genere, compreso il testo delle presenti condizioni di utilizzo.<br/>
                Resta salvo il diritto discrezionale di {{ App\Config::getConf('powered_by') }} di concedere, su richiesta dell’Utente, la propria autorizzazione scritta all’utilizzo di uno o più servizi e per un uso strettamente personale.
            </p>

            <h2>5 – INFORMATIVA SULLA PRIVACY</h2>
            <p>
                I dati personali forniti dall’Utente saranno raccolti ed utilizzati da Celocelo nel pieno rispetto della normativa di cui al D.Lgs. n. 196 del 30 giugno 2003 ( c.d. “ Codice in materia di protezione dei dati personali “ ).<br/>
                Ai sensi e per gli effetti di cui all’Art. 13 D.Lgs. n. 196/03, {{ App\Config::getConf('powered_by') }} rende noto all’ Utente che :
            </p>

            <ul>
                <li>i dati personali forniti da quest’ultimo verranno trattati esclusivamente per la fornitura del servizio richiesto.</li>
                <li>il trattamento dei dati sarà effettuato con modalità informatizzate.</li>
                <li>I dati forniti dall'utente potranno essere condivisi con soggetti terzi esclusivamente previa autorizzazione dell'utente stesso.</li>
                <li>i dati personali raccolti non verranno ceduti a terzi.</li>
                <li>l’eventuale conoscenza di dati personali da parte di terzi (quali a titolo di esempio il nome, il numero telefonico o l’indirizzo) in seguito al trattamento dei medesimi, deriverà esclusivamente dalla scelta volontaria dell’Utente di inserire all’interno dell’annuncio elementi che consentano la propria identificazione.</li>
                <li>il titolare e responsabile del trattamento e della custodia dei dati è {{ App\Config::getConf('powered_by') }}.</li>
            </ul>

            <p>
                L’Utente, accettando le condizioni di utilizzo, autorizza {{ App\Config::getConf('powered_by') }} al trattamento dei propri dati personali entro i limiti e per le finalità indicati nella presente informativa.<br/>
                Al fine di prevenire violazioni dei diritti, delle libertà fondamentali e della dignità degli Interessati, {{ App\Config::getConf('powered_by') }} dichiara di astenersi dal trattare dati sensibili conferiti dall’Utente.<br/>
                Per una adeguata comprensione delle definizioni sovra richiamate, si rammenta che, ai sensi dell’art. 4, comma 1, lett. b, D.Lgs. 196/2003, costituisce “dato personale “ qualunque informazione relativa a persona fisica, persona giuridica, ente od associazione, identificati o identificabili, anche indirettamente, mediante riferimento a qualsiasi altra informazione, ivi compreso un numero di identificazione personale.<br/>
                Ex art. 4, comma 1, lett. d, D.Lgs. 196/2003, costituiscono “dati sensibili” i dati personali idonei a rivelare l’origine razziale ed etnica, le convinzioni religiose, filosofiche o di altro genere, le opinioni politiche, l’adesione a partiti, sindacati, associazioni od organizzazioni a carattere religioso, filosofico, politico o sindacale, nonché i dati personali idonei a rivelare lo stato di salute e la vita sessuale.<br/>
                L’Utente potrà esercitare, in ogni momento, i propri diritti nei confronti del titolare del trattamento, ex Art. 7 D.Lgs. n. 196/2003, di seguito riportato integralmente.<br/>
                Art. 7 D.Lgs.n. 196/2003 (Diritto di accesso ai dati personali ed altri diritti):
            </p>

            <ol>
                <li>
                    L’interessato ha diritto di ottenere la conferma dell’esistenza o meno di dati personali che lo riguardano, anche se non ancora registrati, e la loro comunicazione in forma intelligibile.
                </li>
                <li>
                    L’interessato ha diritto di ottenere l’indicazione:
                    <ul>
                        <li>dell’origine dei dati personali;</li>
                        <li>delle finalità e modalità del trattamento;</li>
                        <li>della logica applicata in caso di trattamento effettuato con l’ausilio di strumenti elettronici</li>
                        <li>degli estremi identificativi del titolare, dei responsabili e del rappresentante designato ai sensi dell’art. 5, comma 2;</li>
                    </ul>
                </li>
                <li>
                    L’interessato ha diritto di ottenere:
                    <ul>
                        <li>l’aggiornamento, la rettificazione, ovvero, quando vi ha interesse, l’integrazione dei dati;</li>
                        <li>la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di Legge, compresi quelli di cui non è necessaria la conservazione in relazione agli scopi per i quali i dati sono stati raccolti o successivamente trattati.</li>
                    </ul>
                </li>
                <li>
                    L’interessato ha diritto di opporsi, in tutto o in parte:
                    <ul>
                        <li>per motivi legittimi al trattamento dei dati personali che lo riguardano, ancorché pertinenti allo scopo della raccolta;</li>
                        <li>al trattamento di dati personali che lo riguardano a fini di invio di materiale pubblicitario o di vendita diretta o per il compimento di ricerche di mercato o di comunicazioni commerciali.</li>
                    </ul>
                </li>
            </ol>

            <p>
                La presente informativa sulla Privacy è aggiornata al 26/06/2017. {{ App\Config::getConf('powered_by') }} si riserva il diritto di modificare la suddetta informativa previo avviso all’Utente, da effettuarsi mediante pubblicazione della versione aggiornata all’interno del sito.
            </p>
             
            <h2>6 - REGOLE PER LA PUBBLICAZIONE DEGLI ANNUNCI</h2>
            <ol>
                <li>
                    Sono vietati annunci contrastanti con la Legge, il buon costume, l'ordine pubblico ovvero lesivi del rispetto, della professionalità e dell'onore di terzi (inserzionisti e non).
                </li>
                <li>
                    E' fatto divieto di pubblicare annunci aventi ad oggetto vendita di cose o servizi
                </li>
                <li>
                    Non è consentito inserire testi o fotografie volgari o offensivi, riferimenti espliciti o impliciti a prestazioni sessuali a pagamento nè alcun tipo di contenuto a sfondo sessuale o pornografico
                </li>
                <li>
                    E' vietato l'inserimento di annunci che riguardino prodotti contraffatti oppure copie illegali di cd/dvd, software, videogiochi e che violino i diritti di proprietà intellettuale (diritti d'autore, marchi, brevetti).
                </li>
                <li>
                    E’ vietato l'inserimento di annunci di prodotti e/o servizi che possono violare la privacy di terze persone
                </li>
                <li>
                    Non sono consentiti annunci riportanti testi diffamatori nei confronti di persone e/o società, testi razzisti e/o discriminanti o che siano solo commenti ad altri annunci pubblicati.
                </li>
                <li>
                    {{ App\Config::getConf('powered_by') }} si riserva il diritto di rimuovere immediatamente, senza alcun avviso, inserzioni lesive di cui ai precedenti punti. L'inserzionista esonera {{ App\Config::getConf('powered_by') }} da qualsivoglia responsabilità, civile, amministrativa, penale conseguente dalla pubblicazione di annunci lesivi ai sensi delle presenti condizioni.
                </li>
            </ol>

            <h2>7 – DISPOSIZIONI FINALI E FORO COMPETENTE</h2>
            <p>
                {{ App\Config::getConf('powered_by') }} si riserva, in ogni tempo, il diritto di revocare, disattivare o modificare, in via temporanea o definitiva, la fornitura del presente servizio nonché di cancellare ed editare le inserzioni degli utenti secondo criteri discrezionali ed insindacabili, senza preavviso all’Utente e senza indicarne le cause.<br/>
                Quest’ultimo concorda, pertanto, che {{ App\Config::getConf('powered_by') }} non sarà responsabile, verso lo stesso o verso terzi, della modifica, sospensione, revoca od interruzione del servizio nonché della cancellazione e modifica dei messaggi inoltrati, qualunque ne siano le modalità di realizzazione.<br/>
                Le presenti condizioni generali ed i rapporti intercorrenti tra {{ App\Config::getConf('powered_by') }} e l’Utente saranno regolati dalla Legge della Repubblica Italiana.<br/>
                Per qualsiasi controversia inerente, derivante o connessa alle presenti condizioni e/o all’utilizzo del servizio sarà esclusivamente competente il Foro di Milano.
            </p>

            <h2>8 – ACCETTAZIONE DELLE CONDIZIONI DI UTILIZZO</h2>
            <p>
                L’Utente, prima di usufruire di qualsivoglia servizio, è tenuto ad informarsi sulla eventuale sussistenza di modifiche e/o aggiornamenti apportati alle condizioni di utilizzo.<br/>
                Tali modifiche e/o aggiornamenti formeranno, infatti, parte integrante delle presenti condizioni generali e costituiranno fonte di accordo tra {{ App\Config::getConf('powered_by') }} e l’Utente.<br/>
                Con la sottostante dichiarazione di accettazione l’Utente dichiara espressamente, ai sensi e per gli effetti di cui agli Artt. 1341, comma 2, e 1342 c.c. di aver letto attentamente e di approvare specificamente le pattuizioni contenute nelle clausole nn. 3 ) esonero da responsabilità e clausola di manleva; 6) regole per la pubblicazione degli annunci 7 ) disposizioni finali e Foro competente 8) accettazione delle condizioni di utilizzo.
            </p>
        </div>
    </div>
@endsection
