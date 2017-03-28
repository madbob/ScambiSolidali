<p class="form-control-static">
    Inserito da:<br/>{{ $donation->user->printableName() }} @include('user.rating', ['user' => $donation->user])
</p>

<hr/>

<p class="form-control-static">{{ $donation->name }} {{ $donation->surname }}</p>
<p class="form-control-static">{{ $donation->phone }}</p>
<p class="form-control-static">{{ $donation->email }}</p>
<p class="form-control-static">{{ $donation->address }}</p>
<p class="form-control-static">{!! nl2br($donation->description) !!}</p>

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
