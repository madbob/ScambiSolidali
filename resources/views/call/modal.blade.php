<div class="modal fade" id="call-{{ $call->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Appello</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::horizontal(['model' => $call, 'store' => 'appello.store', 'update' => 'appello.update']) !!}
                            {!! BootForm::text('title', 'Titolo') !!}
                            {!! BootForm::textarea('who', 'Chi siamo?') !!}
                            {!! BootForm::textarea('what', 'Cosa vogliamo?') !!}
                            {!! BootForm::textarea('whom', 'Per chi?') !!}
                            {!! BootForm::text('when', 'Per quando?', printableDate($call->when), ['class' => 'date']) !!}
                            {!! BootForm::radios('status', 'Stato', [
                                'draft' => 'Bozza (non visibile pubblicamente)',
                                'open' => 'Pubblicato',
                                'archived' => 'Archiviato',
                            ]) !!}
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
