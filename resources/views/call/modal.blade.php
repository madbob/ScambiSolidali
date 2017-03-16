<div class="modal fade" id="{{ $call ? 'call-' . $call->id : 'new-call' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Appello</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 primary-1">
                        {!! BootForm::vertical(['model' => $call, 'store' => 'manca.store', 'update' => 'manca.update']) !!}
                            {!! BootForm::text('title', 'Titolo') !!}
                            {!! BootForm::textarea('who', 'Chi siamo?') !!}
                            {!! BootForm::textarea('what', 'Cosa vogliamo?') !!}
                            {!! BootForm::textarea('whom', 'Per chi?') !!}
                            {!! BootForm::text('when', 'Per quando?', $call ? printableDate($call->when) : '', ['class' => 'date']) !!}

                            @include('category.selector', ['orientation' => 'horizontal', 'selected' => $call ? $call->category_id : null])

                            {!! BootForm::radios('status', 'Stato', [
                                'draft' => 'Bozza (non visibile pubblicamente)',
                                'open' => 'Pubblicato',
                                'archived' => 'Archiviato',
                            ]) !!}

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
