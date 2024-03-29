<p class="form-control-static">
    Inserito da:<br/>{{ $donation->user->printableName() }} @include('user.rating', ['user' => $donation->user])<br>
    {{ printableDate($donation->created_at) }}<br>
    @if($donation->since && $donation->since > date('Y-m-d'))
        Disponibile da {{ printableDate($donation->since) }}
    @endif
    Scade {{ printableDate(date('Y-m-d', strtotime($donation->updated_at . ' +2 months'))) }}
</p>

<hr/>

<p class="form-control-static">{{ $donation->name }} {{ $donation->surname }}</p>

@if($currentuser->role == 'admin' || $currentuser->role == 'operator')
    <p class="form-control-static">{{ $donation->phone }}</p>
    <p class="form-control-static">{{ $donation->email }}</p>
    <p class="form-control-static">{{ $donation->address }}</p>

    @if(App\Config::getConf('explicit_zones') == 'true')
        <p class="form-control-static">{{ $donation->human_area }}</p>
    @endif
@endif

<p class="form-control-static">{!! nl2br($donation->description) !!}</p>

@if($currentuser->role == 'admin' || $currentuser->role == 'operator')
    @if($donation->type == 'object')
        <hr/>

        @if($donation->autoship)
            <div class="alert alert-info">
                Il donatore è disponibile ad effettuare la consegna.
            </div>
        @endif

        @if(!empty($donation->shipping_notes))
            <p class="form-control-static">{!! nl2br($donation->shipping_notes) !!}</p>
        @endif

        @if(!empty($donation->floor))
            <p class="form-control-static">Piano: {{ $donation->floor }}</p>
        @endif

        <p class="form-control-static">Ascensore: {{ $donation->elevator ? 'Si' : 'No' }}</p>

        @if(!empty($donation->size))
            <p class="form-control-static">Altezza: {{ $donation->size_height }}</p>
            <p class="form-control-static">Larghezza: {{ $donation->size_width }}</p>
            <p class="form-control-static">Profondità: {{ $donation->size_deep }}</p>
        @endif
    @endif
@endif
