<div class="modal fade primary-2" id="{{ $call->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $call->category->name }} - {{ $call->title }}</h4>
                <p class="text-muted hidden-xs"><small><br>{{ url('/manca?show=' . $call->id) }}</small></p>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical() !!}
                            <p class="form-control-static">{{ $call->who }}</p>
                            <p class="form-control-static">{{ $call->what }}</p>
                            <p class="form-control-static">{{ $call->whom }}</p>
                            <p class="form-control-static">{{ printableDate($call->when) }}</p>

                            <hr>

                            @if($call->status == 'open')
                                @if($currentuser && $call->category->direct_response)
                                    <form method="POST" action="{{ route('celo.direct', $call->id) }}">
                                        {{ csrf_field() }}

                                        <p>
                                            <small>
                                                Per questo tipo di appello puoi inviare direttamente un messaggio al richiedente per segnalare la tua disponibilità. Chi ha pubblicato l'appello riceverà i tuoi dati per ricontattarti.
                                            </small>
                                        </p>

                                        <div class="form-group">
                                            <label for="message" class="col-md-4 control-label">Messaggio</label>
                                            <div class="col-sm-8">
                                                <textarea name="message" class="form-control" rows="10" required></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default button"><span>Invia</span></button>
                                        </div>
                                    </form>
                                @else
                                    <a href="{{ url('celo/nuovo/' . ($call->type == 'service' ? 'servizio' : 'oggetto') . '?call=' . $call->id) }}" class="btn btn-default button">
                                        <span>Celo!</span>
                                    </a>
                                @endif
                            @endif
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
