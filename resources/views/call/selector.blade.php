@if(App\Call::where('status', 'open')->type('type', $call_type)->count() > 0)
    <br/>
    <p>Seleziona, eventualmente, l'appello a cui stai rispondendo con questa donazione:</p>

    <div class="radio">
        <label>
            <input type="radio" name="call_id" value="-1" {{ $call == null ? 'checked' : '' }}>
            Nessun appello specifico
        </label>
    </div>

    @foreach(App\Call::where('status', 'open')->type('type', $call_type)->get() as $iter_call)
        <div class="radio">
            <label>
                <input type="radio" name="call_id" value="{{ $iter_call->id }}" {{ $call && $call->id == $iter_call->id ? 'checked' : '' }}>
                {{ $iter_call->title }} <a class="show-details" data-endpoint="manca" data-item-id="{{ $iter_call->id }}">(dettagli)</a>
            </label>
        </div>
    @endforeach

    <p>
        Puoi consultare l'elenco completo degli appelli, con i relativi dettagli, su <a href="{{ url('manca') }}">questa pagina</a>.
    </p>

    <br/>
    <br/>
    <br/>
@else
    <input type="hidden" name="call_id" value="{{ $call ? $call->id : -1 }}">
@endif
