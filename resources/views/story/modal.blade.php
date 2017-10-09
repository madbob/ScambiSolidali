<div class="modal fade primary-1" id="story-{{ $story ? $story->id : 'new' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Storia</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical(['model' => $story, 'store' => 'storie.store', 'update' => 'storie.update', 'enctype' => 'multipart/form-data']) !!}
                            {!! BootForm::text('title', 'Titolo') !!}
                            {!! BootForm::textarea('contents', 'Contenuto') !!}
                            {!! BootForm::file('file', 'Immagine') !!}

                            <div class="form-group">
                                <div>
                                    <button class="button" type="submit">
                                        <span>Salva</span>
                                    </button>
                                </div>
                            </div>
                        {!! BootForm::close() !!}

                        @if($story)
                            <form method="POST" action="{{ url('storie/' . $story->id) }}">
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
