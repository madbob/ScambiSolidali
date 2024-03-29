<form class="form-horizontal" method="POST" action="{{ url('donazione/assegna/' . $donation->id) }}">
    {{ csrf_field() }}
    <input type="hidden" name="assignation_type" value="organization">

    <div class="form-group">
        <label for="receiver-organization" class="col-sm-4 control-label">Nome</label>
        <div class="col-sm-8">
            <input type="text" name="receiver-organization" class="form-control" required>
        </div>
    </div>

    <div class="form-group">
        <label for="receiver-receivers" class="col-sm-4 control-label">Numero Beneficiari Potenziali</label>
        <div class="col-sm-8">
            <input type="number" name="receiver-receivers" class="form-control" required>
        </div>
    </div>

    <div class="form-group">
        <label for="receiver-area" class="col-sm-4 control-label">Area</label>
        @include('donation.areaselect', ['selected' => null, 'field_name' => 'receiver-area'])
    </div>

    <div class="form-group">
        <label for="receiver-past" class="col-sm-4 control-label">Quante volte ha fruito di {{ env('APP_NAME') }}?</label>
        <div class="col-sm-8">
            <input type="number" name="receiver-past" class="form-control" value="0" required>
        </div>
    </div>

    <div class="form-group">
        <label for="notes" class="col-md-4 control-label">Note Private</label>
        <div class="col-sm-8">
            <textarea name="notes" class="form-control"></textarea>
            <span class="help-block">Quanto scritto qui sarà accessibile solo agli operatori della piattaforma e non sarà pubblicato.</span>
        </div>
    </div>

    @include('donation.shipping_options', ['donation' => $donation])

    <div class="form-group">
        <button type="submit" class="btn btn-default">Salva</button>

        @if ($donation->type == 'object')
            <span class="help-block">
                Salvando questa assegnazione, il donatore riceverà una mail di notifica.<br>Ricordati di contattarlo per accordarti sul ritiro!
            </span>
        @endif
    </div>
</form>
