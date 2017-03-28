<div class="modal fade" id="{{ $call->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $call->category->name }} - {{ $call->title }}</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 primary-1">
                        {!! BootForm::vertical() !!}
                            <p class="form-control-static">{{ $call->who }}</p>
                            <p class="form-control-static">{{ $call->what }}</p>
                            <p class="form-control-static">{{ $call->whom }}</p>
                            <p class="form-control-static">{{ printableDate($call->when) }}</p>
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
