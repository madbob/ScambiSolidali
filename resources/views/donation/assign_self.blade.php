<form class="form-horizontal" method="POST" action="{{ url('donazione/assegna/' . $donation->id) }}">
    {{ csrf_field() }}
    <input type="hidden" name="assignation_type" value="self">

    <div class="form-group">
        <label for="receiver-age" class="col-sm-4 control-label">Età</label>
        <div class="col-sm-8">
            <input type="number" name="receiver-age" class="form-control" required>
        </div>
    </div>

    <div class="form-group">
        <label for="receiver-gender" class="col-sm-4 control-label">Sesso</label>
        <div class="col-sm-8">
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-gender" value="M" required> Maschile
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-gender" value="F" required> Femminile
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="receiver-status" class="col-sm-4 control-label">Stato</label>
        <div class="col-sm-8">
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-status" value="student" required> Studente
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-status" value="employed" required> Occupato
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-status" value="unemployed" required> Non occupato
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="receiver-children" class="col-sm-4 control-label">Famiglia</label>
        <div class="col-sm-8">
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-children" value="children" required> Ha figli
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-children" value="nochildren" required> Non ha figli
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="receiver-area" class="col-sm-4 control-label">Residenza</label>
        @include('donation.areaselect')
    </div>

    <div class="form-group">
        <label for="receiver-country" class="col-sm-4 control-label">Cittadinanza</label>
        <div class="col-sm-8">
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-country" value="italian" required> Italiana
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-country" value="nonitalian" required> Straniera
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="receiver-past" class="col-sm-4 control-label">Quante volte ha fruito di {{ env('APP_NAME') }}?</label>
        <div class="col-sm-8">
            <input type="number" name="receiver-past" class="form-control" value="0" required>
        </div>
    </div>

    <div class="alert alert-info">
        Scrivi qui un messaggio destinato al donatore, per accordarvi sulla consegna. Il donatore riceverà i tuoi dati di contatto (ma non le informazioni riportate qui sopra, che restano agli amministratori della piattaforma a scopo statistico). Inviando questo form la donazione sarà marcata come "Assegnata".
    </div>

    <div class="form-group">
        <label for="message" class="col-md-4 control-label">Messaggio</label>
        <div class="col-sm-8">
            <textarea name="message" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">Salva</button>
    </div>
</form>
