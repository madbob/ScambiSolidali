<div class="modal fade" id="institute-{{ $institute->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ente</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::horizontal(['model' => $institute, 'store' => 'ente.store', 'update' => 'ente.update']) !!}
                            {!! BootForm::text('name', 'Nome') !!}
                            {!! BootForm::staticField('code', 'Codice', $institute->code, ['help_text' => 'Questo è il codice che gli operatori devono usare nell\'apposito pannello di registrazione']) !!}
                            {!! BootForm::submit('Salva') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
</div>
