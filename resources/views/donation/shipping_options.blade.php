@if ($donation->type == 'object')
    <div class="form-group">
        <label for="shipping" class="col-sm-4 control-label">Richiedi Trasporto</label>
        <div class="col-sm-8">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="shipping" value="1">
                </label>
            </div>

            <span class="help-block">Selezionando questa opzione, l'amministrazione di {{ env('APP_NAME') }} riceverà una mail di richiesta e sarai ricontattato per maggiori accordi.</span>
        </div>
    </div>

    <div class="form-group shipping_details" hidden>
        <label for="shipping" class="col-sm-4 control-label">Indirizzo di Consegna</label>
        <div class="col-sm-8">
            <input type="text" name="shipping_name" class="form-control" placeholder="Nome e cognome destinatario"><br>
            <input type="text" name="shipping_address" class="form-control" placeholder="Indirizzo di Consegna (via, numero civico, città...)"><br>
            <input type="text" name="shipping_floor" class="form-control" placeholder="Piano di Consegna (terra, primo, secondo...)"><br>
			<p><input id="shipping_elevator" type="checkbox" name="shipping_elevator"> C'è l'ascensore</p>
            <input type="text" name="shipping_phone" class="form-control" placeholder="Telefono destinatario"><br>
        </div>
    </div>
@endif
