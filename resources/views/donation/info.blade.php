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
