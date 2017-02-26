<?php $role = Auth::user()->role ?>

<div class="modal fade" id="info-{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="info">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ $donation->category->name }} | {{ $donation->title }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        @for($i = 1; $i <= $donation->imagesNum(); $i++)
                            <img src="{{ $donation->imageUrl($i) }}" class="img-responsive">
                        @endfor
                    </div>
                    <div class="col-md-6">
                        <form class="form-horizontal">
                            @include('donation.info', ['donation' => $donation])

                            @if($role == 'admin' || $role == 'operator')
                                @if($donation->recoverable)
                                    <div class="alert alert-info">Marcato per il possibile recupero</div>
                                    @if($donation->really_recoverable)
                                        <div class="alert alert-info">Recuperabile alla scadenza</div>
                                    @endif
                                @else
                                    <div class="alert alert-info">Non marcato per il recupero</div>
                                @endif

                                @if($donation->receivers->isEmpty() == false)
                                    <hr/>
                                    @include('donation.minilist', ['list' => $donation->receivers, 'print_receiver' => true, 'print_object' => false])
                                @endif

                                @if($donation->status == 'pending')
                                    <hr/>
                                    <button class="btn btn-default" role="button" data-toggle="collapse" href="#flagPanel-{{ $donation->id }}" aria-expanded="false" aria-controls="flagPanel-{{ $donation->id }}">Segnala Interesse</button> <button class="btn btn-success" role="button" data-toggle="collapse" href="#assignPanel-{{ $donation->id }}" aria-expanded="false" aria-controls="assignPanel-{{ $donation->id }}">Oggetto Assegnato</button> <button class="btn btn-danger" role="button" data-toggle="collapse" href="#removePanel-{{ $donation->id }}" aria-expanded="false" aria-controls="removePanel-{{ $donation->id }}">Elimina</button>
                                @endif
                            @else
                                @if($donation->recoverable)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="single-saving-notice-toggle" data-endpoint="{{ url('donazione/recuperabile/' . $donation->id) }}" {{ $donation->really_recoverable ? 'checked="checked"' : '' }}> Recuperabile alla scadenza <span class="single-saving-notice"></span>
                                        </label>
                                    </div>
                                @else
                                    <div class="alert alert-info">Non marcato per il possibile recupero alla scadenza</div>
                                @endif
                            @endif
                        </form>

                        @if($role == 'admin' || $role == 'operator')
                            <div class="collapse" id="flagPanel-{{ $donation->id }}">
                                <div class="well">
                                    <form class="form-horizontal" method="POST" action="{{ url('donazione/prenota/' . $donation->id) }}">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="holder" class="col-sm-4 control-label">Destinato a</label>
                                            <div class="col-sm-8">
                                                <select class="chosen-select" name="holder" placeholder="Seleziona l'utente dall'elenco">
                                                    @foreach(App\Receiver::orderBy('surname', 'asc')->get() as $receiver)
                                                        <option value="{{ $receiver->id }}">{{ $receiver->surname }} {{ $receiver->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="notes" class="col-sm-4 control-label">Note</label>
                                            <div class="col-sm-8">
                                                <textarea name="notes" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-default">Salva</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="collapse" id="assignPanel-{{ $donation->id }}">
                                <div class="well">
                                    <form class="form-horizontal" method="POST" action="{{ url('donazione/assegna/' . $donation->id) }}">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="holder" class="col-sm-4 control-label">Assegnato a</label>
                                            <div class="col-sm-8">
                                                <select class="chosen-select" name="holder" placeholder="Seleziona l'utente dall'elenco">
                                                    @foreach(App\Receiver::orderBy('surname', 'asc')->get() as $receiver)
                                                        <option value="{{ $receiver->id }}">{{ $receiver->surname }} {{ $receiver->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="notes" class="col-sm-4 control-label">Note Private</label>
                                            <div class="col-sm-8">
                                                <textarea name="notes" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="shipping"> Richiedi Trasporto
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-default">Salva</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="collapse" id="removePanel-{{ $donation->id }}">
                                <div class="well">
                                    <form class="form-horizontal" method="POST" action="{{ url('donazione/' . $donation->id) }}">
                                        <input type="hidden" name="_method" value="delete">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="holder" class="col-sm-4 control-label">Motivo</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="reason">
                                                    @foreach(App\Donation::declineReasons() as $identifier => $reason)
                                                    <option value="{{ $identifier }}">{{ $reason->text }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-default">Elimina</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
