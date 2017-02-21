<p class="form-control-static">
    Inserito da: {{ $donation->user->printableName() }}
    @include('user.rating', ['user' => $donation->user])
</p>

<hr/>

<p class="form-control-static">{{ $donation->name }} {{ $donation->surname }}</p>
<p class="form-control-static">{{ $donation->phone }}</p>
<p class="form-control-static">{{ $donation->email }}</p>
<p class="form-control-static">{{ $donation->address }}</p>
<p class="form-control-static">{!! nl2br($donation->description) !!}</p>

<hr/>

@if(!empty($donation->shipping_notes))
    <p class="form-control-static">{!! nl2br($donation->shipping_notes) !!}</p>
@endif

<p class="form-control-static">Piano: {{ $donation->floor }}</p>
<p class="form-control-static">Ascensore: {{ $donation->elevator ? 'Si' : 'No' }}</p>
