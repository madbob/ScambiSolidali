<?php

$has_donations = ($call && $call->donations()->count() != 0);

?>

<div class="modal fade" id="{{ $call ? 'call-' . $call->id : 'new-call' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Appello</h4>
            </div>

            <div class="modal-body primary-1">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical(['model' => $call, 'store' => 'manca.store', 'update' => 'manca.update']) !!}
                            @if($call)
                                <p>
                                    Creato {{ printableDate($call->created_at) }} da {{ $call->user->printableName() }}
                                </p>
                                <br>
                            @endif

                            {!! BootForm::text('title', 'Titolo', null, ['required' => 'required']) !!}
                            {!! BootForm::textarea('who', 'Chi siamo?', null, ['required' => 'required']) !!}
                            {!! BootForm::textarea('what', 'Cosa vogliamo?', null, ['required' => 'required']) !!}
                            {!! BootForm::textarea('whom', 'Per chi?', null, ['required' => 'required']) !!}
                            {!! BootForm::text('when', 'Per quando?', $call ? printableDate($call->when) : '', ['class' => 'date', 'required' => 'required']) !!}

                            @include('category.selector', [
                                'orientation' => 'horizontal',
                                'selected' => $call ? $call->category_id : null,
                                'type' => 'all',
                                'direct_response' => true
                            ])

                            {!! BootForm::textarea('notes', 'Note (private, visualizzate solo agli operatori)', null) !!}

                            {!! BootForm::radios('status', 'Stato', [
                                'draft' => 'Bozza (non visibile pubblicamente)',
                                'open' => 'Pubblicato',
                                'closed' => 'Chiuso',
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

                    @if($has_donations)
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Utente</th>
                                            <th>Link</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($call->donations as $item)
                                            <tr>
                                                <td>{{ ucwords(strftime('%d/%m/%G', strtotime($item->updated_at))) }}</td>
                                                <td>{{ $item->user->printableName() }}</td>
                                                <td><a href="{{ url('celo/?show=' . $item->id) }}">Visualizza</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
