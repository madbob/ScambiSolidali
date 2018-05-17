<div class="modal fade primary-2" id="{{ $call->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $call->type == 'service' ? 'Servizi' : $call->category->name }} - {{ $call->title }}</h4>
                <p class="text-muted"><small><br>{{ url('/manca?show=' . $call->id) }}</small></p>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical() !!}
                            <p class="form-control-static">{{ $call->who }}</p>
                            <p class="form-control-static">{{ $call->what }}</p>
                            <p class="form-control-static">{{ $call->whom }}</p>
                            <p class="form-control-static">{{ printableDate($call->when) }}</p>

                            <br/>

                            @if($call->status == 'open')
                                <a href="{{ url('celo/nuovo/' . ($call->type == 'service' ? 'servizio' : 'oggetto') . '?call=' . $call->id) }}" class="btn btn-default button">
                                    <span>Celo!</span>
                                </a>
                            @endif
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
