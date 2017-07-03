<div class="modal fade primary-1" id="institute-{{ $institute ? $institute->id : 'new' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ente</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical(['model' => $institute, 'store' => 'ente.store', 'update' => 'ente.update']) !!}
                            {!! BootForm::text('name', 'Nome') !!}
                            {!! BootForm::text('website', 'Sito Web') !!}

                            <div class="form-group">
                                <label for="address" class="control-label">Indirizzo</label>
                                <div>
                                    <input type="hidden" name="address" value="{{ $institute ? $institute->address : '' }}">
                                    <input type="hidden" name="coordinates" value="{{ $institute ? ($institute->lat . ',' . $institute->lng) : '' }}">
                                    <div class="map-select" id="institute-address-selection-{{ $institute ? $institute->id : 'new' }}"></div>
                                    <span class="help-block">Attenzione: digita un indirizzo e selezionalo dal menu di autocompletamento. Se l'indirizzo non viene completato in questo modo, non sarà possibile risalire alle coordinate desiderate</span>
                                </div>
                            </div>

                            {!! BootForm::staticfield('code', 'Codice', $institute ? $institute->code : ($code = str_random(10)), ['help_text' => 'Questo è il codice che gli operatori devono usare nell\'apposito pannello di registrazione', 'disabled' => 'disabled']) !!}
                            @if($institute == null)
                                <input type="hidden" name="code" value="{{ $code }}">
                            @endif

                            <br/>

                            <div class="form-group">
                                <div>
                                    <button class="button" type="submit">
                                        <span>Salva</span>
                                    </button>
                                </div>
                            </div>
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
