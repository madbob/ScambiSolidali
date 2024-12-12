<p>
    Inserito da:<br/>{{ $donation->user->printableName() }} @include('user.rating', ['user' => $donation->user])<br>
    Creazione: {{ printableDate($donation->created_at) }}<br>
    @if($donation->since && $donation->since > date('Y-m-d'))
        Disponibile da: {{ printableDate($donation->since) }}
    @endif
    Scadenza: {{ printableDate(date('Y-m-d', strtotime($donation->updated_at . ' +2 months'))) }}
</p>

<hr/>

<p>{{ $donation->name }} {{ $donation->surname }}</p>

@if($currentuser->role == 'admin' || $currentuser->role == 'operator')
    <p>{{ $donation->phone }}</p>
    <p>{{ $donation->email }}</p>
    <p>{{ $donation->address }}</p>

    @if(App\Config::getConf('explicit_zones') == 'true')
        <p>{{ $donation->human_area }}</p>
    @endif
@endif

<p>{!! nl2br($donation->description) !!}</p>

@if($currentuser->role == 'admin' || $currentuser->role == 'operator')
    @if($donation->type == 'object')
        <hr/>

        @if($donation->autoship)
            <div class="alert alert-info">
                Il donatore è disponibile ad effettuare la consegna.
            </div>
        @endif

        @if(!empty($donation->shipping_notes))
            <p>{!! nl2br($donation->shipping_notes) !!}</p>
        @endif

        @if(!empty($donation->floor))
            <p>Piano: {{ $donation->floor }}</p>
        @endif

        <p>Ascensore: {{ $donation->elevator ? 'Si' : 'No' }}</p>

        @if(!empty($donation->size))
            <p>Altezza: {{ $donation->size_height }}</p>
            <p>Larghezza: {{ $donation->size_width }}</p>
            <p>Profondità: {{ $donation->size_deep }}</p>
        @endif
    @endif
@endif
