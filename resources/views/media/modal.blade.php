<div class="modal fade primary-1" id="media-{{ $media ? $media->id : 'new' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Articolo</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical(['model' => $media, 'store' => 'parlano-di-noi.store', 'update' => 'parlano-di-noi.update', 'enctype' => 'multipart/form-data']) !!}
                            {!! BootForm::text('channel', 'Testata') !!}
                            {!! BootForm::text('date', 'Data', $media ? printableDate($media->date) : '', ['class' => 'date']) !!}
                            {!! BootForm::text('link', 'Link') !!}
                            {!! BootForm::file('file', 'File') !!}

                            <div class="form-group">
                                <div>
                                    <button class="button" type="submit">
                                        <span>Salva</span>
                                    </button>
                                </div>
                            </div>
                        {!! BootForm::close() !!}

                        @if($media)
                            <form method="POST" action="{{ url('parlano-di-noi/' . $media->id) }}">
                                <input type="hidden" name="_method" value="DELETE">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <div>
                                        <button class="button" type="submit">
                                            <span>Elimina</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
