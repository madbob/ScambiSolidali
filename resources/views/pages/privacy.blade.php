@extends('layouts.app')

@section('title', 'Giocatori')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>INFORMATIVA SULLA PRIVACY</h1>

            <p>
                La presente informativa viene resa ai sensi dell´art. 13 della D.lgs. n. 196/2003
            </p>

            <h3>Titolare del trattamento</h3>
            <p>
                L´interessato potrà rivolgersi, in ogni tempo, al titolare del trattamento dei dati, indirizzando le proprie richieste a : Associazione Agenzia per lo sviluppo locale di San Salvario ONLUS – via Morgari 14 – 10125 – Torino.
            </p>
             
            <h3>Tipi di dati trattati e finalità del relativo trattamento</h3>
            <ol>
                <li>
                    Dati di navigazione: Durante la navigazione sul sito http://www.celocelo.it i sistemi informatici e le procedure software che presiedono al funzionamento del sito raccolgono alcuni dati personali la cui trasmissione è implicita nell´uso dei protocolli di comunicazione Internet. Esempi di questa tipologia di dati sono gli indirizzi IP o i nomi a dominio dei computer utilizzati dagli utenti che si collegano al sito, gli indirizzi URI (Uniform Resource Identifier) delle risorse richieste, l´orario della richiesta, il metodo utilizzato nel sottoporre la richiesta al server, la dimensione del file ottenuto in risposta, il codice numerico che indica la risposta data dal server (buon fine, errore, ecc.) ed altre informazioni relative al sistema operativo e all´ambiente informatico dell´utente. I dati di cui sopra, pur non essendo di per sé soli riconducibili ad utenti identificati, potrebbero permettere di identificare gli utenti a cui si riferiscono attraverso rielaborazioni con dati in possesso di terzi. Essi vengono tuttavia utilizzati dalla associazione al solo fine di controllare il corretto funzionamento di quest´ultimo e vengono cancellati immediatamente dopo l´elaborazione. Tali dati potrebbero inoltre essere utilizzati per l´accertamento di responsabilità in caso di ipotetici reati informatici ai danni del sito. A parte questa ipotesi, di regola essi vengono conservati per non più di sette giorni.
                </li>
                <li>
                    Cookies: il sito http://www.celocelo.it fa uso di cookies, che vengono memorizzati sul computer dell´utente che l´Utente potrà, in ogni momento disattivare, tale disattivazione potrebbe comportare, tuttavia, l´impossibilità di utilizzare alcuni servizi. L´uso di tali cookies è legato alla trasmissione di identificativi di sessione (costituiti da numeri casuali generati dal server) necessari per consentire la navigazione sicura ed efficiente del sito e permette di evitare il ricorso ad altre tecniche informatiche potenzialmente pregiudizievoli per la riservatezza della navigazione degli utenti. Tali cookies non consentono l´acquisizione di dati personali identificativi dell´utente.
                </li>
            </ol>

            <h3>Dati forniti per la fruizione e l´iscrizione ai servizi gratuiti del sito</h3>
            <p>
                L’utente, iscrivendosi al sito www.celocelo.it dovrà confermare di aver preso visione delle condizioni d’uso e dell’informativa privacy per il trattamento dei propri dati aventi finalità connesse alla fornitura del servizio. L’utente potrà inoltre esprimere liberamente i consensi all’utilizzo dei propri dati. I dati dell’utente verranno utilizzati esclusivamente per le finalità socio-assistenziali previste dal sito e per elaborazioni anonime dei dati, utili all’implementazione del servizio.
            </p>
             
            <h3>Modalità del trattamento</h3>
            <p>
                I trattamenti potranno essere eseguiti con modalità informatiche o manuali con procedure tali da garantirne la conformità alle disposizioni normative vigenti in materia. Specifiche misure di sicurezza sono adottate per prevenire la perdita dei dati, l´usi illecito o non corretto e l´accesso non autorizzato agli stessi.
            </p>
             
            <h3>Natura del conferimento</h3>
            <p>
                I dati personali dell’utente saranno trattati dai dipendenti che operano sotto la diretta autorità del rispettivo "Responsabile del trattamento" e che sono stati designati Incaricati del trattamento ed hanno ricevuto, al riguardo, adeguate istruzioni operative, con particolare riferimento all´adozione delle misure minime di sicurezza, al fine di poter garantire la riservatezza e la sicurezza dei dati. Presso la nostra sede è possibile acquisire l´elenco dei responsabili del trattamento nominati. L’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS adotta ed osserva specifiche misure di sicurezza al fine di prevenire la perdita dei dati conferiti, eventuali usi illeciti o non corretti dei medesimi ed accessi non autorizzati. Salvi i limiti di Legge, l’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS non è in alcun modo responsabile delle perdite economiche, nè dei danni diretti od indiretti eventualmente subiti dall´Utente o da terzi in conseguenza dell´utilizzo del sito o del proprio servizio.
            </p>
             
            <h3>Diritti degli interessati</h3>
            <p>
                Ai sensi dell´art. 7 del D.lgs 196/2003 (e successive modifiche), gli utenti cui si riferiscono i dati personali hanno il diritto in qualunque momento di ottenere la conferma dell´esistenza o meno dei medesimi dati e di conoscerne il contenuto e l´origine, anche per verificarne l´esattezza o chiederne l´integrazione o l´aggiornamento, oppure la rettificazione. Ai sensi del medesimo articolo gli utenti hanno inoltre il diritto di chiedere la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge nonchè di opporsi in ogni caso, per motivi legittimi, al loro trattamento. Le richieste vanno inviate a Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS, via Morgari 14, 10125, Torino, email: segreteria@agenzia.sansalvario.org.
            </p>

            <h1>CONDIZIONI DI UTILIZZO</h1>

            <p>
                L’utilizzo del servizio Celocelo è regolato nei termini ed alle condizioni di seguito riportate.<br/>
                La fruizione del servizio e dei contenuti offerti da Celocelo comporta e presuppone l’integrale conoscenza e l’incondizionata accettazione delle clausole sottoelencate.
            </p>

            <h2>1 - INDIVIDUAZIONE DEL SERVIZIO E DEI CONTENUTI OFFERTI DA CELOCELO</h2>
            <p>
                Ass. Agenzia per lo sviluppo locale di San Salvario onlus, con sede legale in via Morgari 14, 10125, Torino consente ai destinatari del proprio servizio di immettere, pubblicare e consultare gratuitamente annunci online di natura NON commerciale, al fine di facilitare la donazione di oggetti, competenze e tempo/lavoro volontario, destinate a persone in condizione di fragilità economica e sociale e/o ad organizzazioni non profit che operano nell’ambito della lotta all’esclusione sociale.
            </p>

            <h2>2 - OBBLIGHI E CONDOTTA DELL’UTENTE</h2>
            <p>
                Nell'ambito della presente sezione (Termini e condizioni d'uso) di Servizio con il termine "Utente/i" si intendono sia gli utenti navigatori che gli utenti inserzionisti.<br/>
                Il servizio potrà essere utilizzato dai maggiori di anni diciotto.<br/>
                L’eventuale utilizzo del servizio da parte dei minori, presuppone e sottintende l’autorizzazione dei genitori o di chi, sugli stessi, esercita la potestà o la tutela.<br/>
                Costoro si assumono, pertanto, la piena ed esclusiva responsabilità di qualsivoglia comportamento tenuto dal minore nell’accesso, nell’utilizzo e nella fruizione del servizio.<br/>
                L'Utente prende atto che celocelo.it non effettuerà alcun controllo preventivo sul contenuto degli annunci immessi in rete, né svolgerà alcuna attività di intermediazione sugli eventuali accordi intercorrenti tra gli Utenti medesimi per il conferimento del bene donato.<br/>
                Questi ultimi si assumono, pertanto, la piena ed esclusiva responsabilità, verso Celocelo e verso i terzi, del comportamento tenuto.<br/>
                L'Utente fa uso del servizio messo a disposizione da celocelo.it nella consapevolezza che quest'ultima non garantisce alcunché in ordine alla veridicità del contenuto degli annunci o al buon esito delle donazioni.<br/>
                Pubblicando il proprio annuncio su celocelo.it l'utente autorizza l’ass. Agenzia per lo sviluppo locale di San Salvario ONLUS e le organizzazioni partner ad adoperarsi affinché il contenuto dell'annuncio venga reso visibile ed accessibile agli utenti della rete anche mediante successiva indicizzazione su motori di ricerca, mediante pubblicazione su altri siti e social network, al fine di promuovere con più efficacia le inserzioni dei propri utenti e facilitare la buona riuscita della donazione.
            </p>
            <p>
                L’Utente si impegna a non fruire dei servizi fornitigli da Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS e/o dal sito www.celicelo.it in modo improprio o contrario alle disposizioni di Legge e regolamentari ed alle norme di Etica e di Buon uso dei servizi di rete.<br/>
                In particolare, l’Utente si impegna a non trasmettere, tramite celocelo.it, materiale di natura offensiva, calunniosa, diffamatoria, pornografica, pedopornografica, volgare, oscena, blasfema, o comunque contraria ai principi dell’ordine pubblico e del buon costume.<br/>
                L'Utente è consapevole che l'indirizzo di posta elettronica reso noto su celocelo.it potrà valere quale mezzo di comunicazione a distanza.<br/>
                L'Utente si impegna ad inoltrare annunci redatti in maniera accurata e veritiera, in particolare avendo riguardo alle caratteristiche pericolose/difettose degli oggetti in vendita, specialmente se in grado di procurare un pregiudizio a chi ne facesse uso.<br/>
                L'Utente dichiara di utilizzare il servizio offerto da celocelo.it nella consapevolezza di poter incontrare link che possono rinviare a pagine web su cui celocelo.it non ha alcun controllo e sul cui contenuto non assume alcuna responsabilità.<br/>
                L’Utente dichiara espressamente di astenersi da qualsivoglia discriminazione, diretta o indiretta, a causa della razza o dell’origine etnica degli individui, conformemente a quanto disposto in materia dal D.Lgs. n. 215/2003 e si impegna al rispetto delle Convenzioni poste a salvaguardia dei diritti umani.<br/>
                L’Utente si impegna a non pubblicare in rete, senza il consenso degli aventi diritto, inserzioni contenenti dati personali, sensibili e/o immagini di minori o di terzi, nonché materiale contenente virus o altri sistemi tesi a danneggiare il funzionamento del presente servizio o di qualsivoglia impianto deputato alla telediffusione.<br/>
                L'Utente si obbliga a non incoraggiare, commettere, favorire e/o agevolare in qualunque modo, mediante gli spazi messi a disposizione da celocelo.it, azioni criminali e comportamenti illeciti in generale. L'Utente si obbliga a non pregiudicare l'uso ed il godimento del Servizio degli altri utenti.<br/>
                Mediante l’utilizzo delle risorse offerte da celocelo.it, l'Utente si obbliga a non riprodurre, trascrivere, duplicare, distribuire, modificare o comunicare, senza averne diritto, materiale protetto dal diritto di autore ed a rispettare, in generale, qualsivoglia disposizione di cui alla L. n. 633/1941 e succ. modd. <br/>
                L’Utente si impegna a non richiedere la pubblicazione di annunci mendaci o aventi ad oggetto beni di provenienza illecita e/o, a qualsiasi titolo.<br/>
                L’Utente dichiara, altresì, di astenersi dall’inviare a qualunque terzo materiale informativo e/o pubblicitario non richiesto.<br/>
                Resta ferma l’insussistenza di qualsivoglia attività di intermediazione tra la domanda e l’offerta di lavoro da parte di celocelo.it, dell’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS e dei suoi partner.<br/>
                Celocelo.it si limita, infatti, ad offrire all’Utente uno spazio web per la pubblicazione dei propri annunci.<br/>
                L’Utente si impegna a non pubblicare inserzioni aventi ad oggetto l’offerta di prestazioni a carattere sessuale in cambio di denaro, o facenti riferimento ad organi sessuali, ovvero recanti immagini oscene e/o inappropriate.<br/>
                L’Utente sarà, pertanto, l’unico ed esclusivo responsabile del contenuto dei propri argomenti di discussione, i quali costituiscono espressione di libera manifestazione del pensiero, costituzionalmente tutelata, e dovranno svolgersi nel pieno rispetto dei limiti di Legge.<br/>
                L'Utente dichiara in particolare di usufruire del servizio messo a disposizione da celocelo.it SENZA ALCUNA FINALITA’ COMMERCIALE. Beni e servizi trattati da celocelo.it non avranno MAI essere oggetto di transazione commerciale o comportare forme di pagamento di corrispettivo anche non monetario.
            </p>

            <h2>3 – ESONERO DA RESPONSABILITA’ E CLAUSOLA DI MANLEVA</h2>
            <p>
                L’Utente, quale necessaria conseguenza della propria piena ed esclusiva responsabilità eventualmente derivante dalla violazione di Leggi, regolamenti e delle presenti condizioni generali, dichiara espressamente di esonerare celocelo.it da qualsivoglia responsabilità, civile e penale, riconoscendone, fin d’ora, il difetto di legittimazione passiva in giudizio.<br/>
                In particolare, l’Utente si obbliga a manlevare celocelo.it, sostanzialmente e processualmente, da qualsiasi pregiudizio, perdita, danno, responsabilità, costo, o­nere o spesa, incluse le spese legali, derivanti da pretese o da azioni avanzate da terzi, in qualunque sede ed a qualunque titolo, in conseguenza di annunci od opinioni immessi in rete dall’Utente mediante l’utilizzo improprio delle risorse offerte da celocelo.it e dalle interazioni e transazioni di beni e servizi ad esso conseguenti.
            </p>

            <h2>4 – DIRITTI RISERVATI</h2>
            <p>
                celocelo.it è titolare di tutti i servizi ed i contenuti messi a disposizione dell’Utente tramite il proprio sito web.<br/>
                E’, pertanto, vietata la riproduzione e/o l’utilizzazione, integrale o parziale, a titolo gratuito od o­neroso, di qualsivoglia risorsa del sito, della vesta grafica, di simboli, marchi, loghi o segni distintivi in genere, compreso il testo delle presenti condizioni di utilizzo.<br/>
                Resta salvo il diritto discrezionale di ass. Agenzia per lo sviluppo locale di San Salvario ONLUS di concedere, su richiesta dell’Utente, la propria autorizzazione scritta all’utilizzo di uno o più servizi e per un uso strettamente personale.
            </p>

            <h2>5 – INFORMATIVA SULLA PRIVACY</h2>
            <p>
                I dati personali forniti dall’Utente saranno raccolti ed utilizzati da celocelo.it nel pieno rispetto della normativa di cui al D.Lgs. n. 196 del 30 giugno 2003 ( c.d. “ Codice in materia di protezione dei dati personali “ ).<br/>
                Ai sensi e per gli effetti di cui all’Art. 13 D.Lgs. n. 196/03, Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS rende noto all’ Utente che :
            </p>

            <ul>
                <li>i dati personali forniti da quest’ultimo verranno trattati esclusivamente per la fornitura del servizio richiesto.</li>
                <li>il trattamento dei dati sarà effettuato con modalità informatizzate.</li>
                <li>I dati forniti dall'utente potranno essere condivisi con soggetti terzi esclusivamente previa autorizzazione dell'utente stesso.</li>
                <li>i dati personali raccolti non verranno ceduti a terzi.</li>
                <li>l’eventuale conoscenza di dati personali da parte di terzi (quali a titolo di esempio il nome, il numero telefonico o l’indirizzo) in seguito al trattamento dei medesimi, deriverà esclusivamente dalla scelta volontaria dell’Utente di inserire all’interno dell’annuncio elementi che consentano la propria identificazione.</li>
                <li>il titolare e responsabile del trattamento e della custodia dei dati è Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS.</li>
            </ul>

            <p>
                L’Utente, accettando le condizioni di utilizzo, autorizza Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS al trattamento dei propri dati personali entro i limiti e per le finalità indicati nella presente informativa.<br/>
                Al fine di prevenire violazioni dei diritti, delle libertà fondamentali e della dignità degli Interessati, Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS dichiara di astenersi dal trattare dati sensibili conferiti dall’Utente.<br/>
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
                La presente informativa sulla Privacy è aggiornata al 26/06/2017. L’ Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS si riserva il diritto di modificare la suddetta informativa previo avviso all’Utente, da effettuarsi mediante pubblicazione della versione aggiornata all’interno del sito.
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
                    L’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS si riserva il diritto di rimuovere immediatamente, senza alcun avviso, inserzioni lesive di cui ai precedenti punti. L'inserzionista esonera l’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS da qualsivoglia responsabilità, civile, amministrativa, penale conseguente dalla pubblicazione di annunci lesivi ai sensi delle presenti condizioni.
                </li>
            </ol>
             
            <h2>7 – DISPOSIZIONI FINALI E FORO COMPETENTE</h2>
            <p>
                L’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS si riserva, in ogni tempo, il diritto di revocare, disattivare o modificare, in via temporanea o definitiva, la fornitura del presente servizio nonché di cancellare ed editare le inserzioni degli utenti secondo criteri discrezionali ed insindacabili, senza preavviso all’Utente e senza indicarne le cause.<br/>
                Quest’ultimo concorda, pertanto, che l’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS non sarà responsabile, verso lo stesso o verso terzi, della modifica, sospensione, revoca od interruzione del servizio nonché della cancellazione e modifica dei messaggi inoltrati, qualunque ne siano le modalità di realizzazione.<br/>
                Le presenti condizioni generali ed i rapporti intercorrenti tra l’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS e l’Utente saranno regolati dalla Legge della Repubblica Italiana.<br/>
                Per qualsiasi controversia inerente, derivante o connessa alle presenti condizioni e/o all’utilizzo del servizio sarà esclusivamente competente il Foro di Milano.
            </p>

            <h2>8 – ACCETTAZIONE DELLE CONDIZIONI DI UTILIZZO</h2>
            <p>
                L’Utente, prima di usufruire di qualsivoglia servizio, è tenuto ad informarsi sulla eventuale sussistenza di modifiche e/o aggiornamenti apportati alle condizioni di utilizzo.<br/>
                Tali modifiche e/o aggiornamenti formeranno, infatti, parte integrante delle presenti condizioni generali e costituiranno fonte di accordo tra l’Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS e l’Utente.<br/>
                Con la sottostante dichiarazione di accettazione l’Utente dichiara espressamente, ai sensi e per gli effetti di cui agli Artt. 1341, comma 2, e 1342 c.c. di aver letto attentamente e di approvare specificamente le pattuizioni contenute nelle clausole nn. 3 ) esonero da responsabilità e clausola di manleva; 6) regole per la pubblicazione degli annunci 7 ) disposizioni finali e Foro competente 8) accettazione delle condizioni di utilizzo.
            </p>
        </div>
    </div>
@endsection
