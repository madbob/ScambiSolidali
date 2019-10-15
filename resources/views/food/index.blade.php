@extends('layouts.food')

@section('title', 'Food')

@section('content')
    <div class="project">
        <div class="row primary-6">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                <img src="{{ url('images/call_food.jpg') }}" alt="Appello Volontari Celocelo Food" class="img-responsive">
            </div>
            <div class="col-md-12">
                <iframe width="100%" height="315" src="https://www.youtube-nocookie.com/embed/9cQ4_Sn4yfE?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-12">
                <div class="button screaming-border postcard">
                    <div class="row">
                        <div class="col-md-4">
                            <h2>
                                Recuperiamo eccedenze alimentari come se ci fosse un domani.
                            </h2>
                        </div>
                        <div class="col-md-4">
                            <h3>Hai del cibo invenduto?</h3>
                            <p>Se a fine giornata lavorativa pensi di avere delle eccedenze che non puoi più vendere o che semplicemente vuoi regalare, faccelo sapere.</p>

                            <br>

                            <h3>Non hai un negozio?</h3>
                            <p>Parla con i tuoi negozianti di fiducia, puoi comprare degli alimenti che verranno dati a chi ne ha più bisogno.</p>
                        </div>
                        <div class="col-md-4">
                            <h3>Come funziona?</h3>
                            <p class="hard-bg">Tutti i sabati, alla chiusura passeremo nel tuo negozio con tutti i materiali necessari per la raccolta dell'eventuale eccedenza e la corretta gestione degli alimenti anche cucinati. Il cibo verrà immediatamente portato a operatori accreditati che gestiscono persone e famiglie per cui le tue donazioni alimentari fanno certamente la differenza.<br>La donazione ti permetterà di accedere a sgravi fiscali.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row footer-credits">
            <div class="col-md-12">
                <div class="text-center">
                    {!! App\Config::getConf('food_credits') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
