<?php $role = Auth::user()->role ?>

<div class="modal fade" id="info-{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="info">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Servizi | {{ $donation->title }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal">
                            @include('donation.info', ['donation' => $donation])
                        </form>
                    </div>

                    @if($role == 'admin' || $role == 'operator')
                        <div class="row">
                            <div class="col-md-12">
                                @if($donation->receivers->isEmpty() == false)
                                    <hr/>
                                    @include('donation.minilist', ['list' => $donation->receivers, 'print_receiver' => true, 'print_object' => false])
                                @endif

                                @if($donation->status == 'pending')
                                    <hr/>
                                    <button class="btn btn-default" role="button" data-toggle="collapse" href="#flagPanel-{{ $donation->id }}" aria-expanded="false" aria-controls="flagPanel-{{ $donation->id }}">Segnala Interesse</button> <button class="btn btn-success" role="button" data-toggle="collapse" href="#assignPanel-{{ $donation->id }}" aria-expanded="false" aria-controls="assignPanel-{{ $donation->id }}">Oggetto Assegnato</button> <button class="btn btn-danger" role="button" data-toggle="collapse" href="#removePanel-{{ $donation->id }}" aria-expanded="false" aria-controls="removePanel-{{ $donation->id }}">Elimina</button>
                                @endif

                                <div class="collapse" id="flagPanel-{{ $donation->id }}">
                                    <div class="well">
                                        <form class="form-vertical" method="POST" action="{{ url('donazione/prenota/' . $donation->id) }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="holder" class="control-label">Destinato a</label>
                                                <select class="chosen-select" name="holder" placeholder="Seleziona l'utente dall'elenco">
                                                    @foreach(App\Receiver::orderBy('surname', 'asc')->get() as $receiver)
                                                        <option value="{{ $receiver->id }}">{{ $receiver->surname }} {{ $receiver->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="notes" class="control-label">Note</label>
                                                <textarea name="notes" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default">Salva</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="collapse" id="assignPanel-{{ $donation->id }}">
                                    <div class="well">
                                        <form class="form-vertical" method="POST" action="{{ url('donazione/assegna/' . $donation->id) }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="holder" class="control-label">Assegnato a</label>
                                                <select class="chosen-select" name="holder" placeholder="Seleziona l'utente dall'elenco">
                                                    @foreach(App\Receiver::orderBy('surname', 'asc')->get() as $receiver)
                                                        <option value="{{ $receiver->id }}">{{ $receiver->surname }} {{ $receiver->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="notes" class="control-label">Note Private</label>
                                                <textarea name="notes" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default">Salva</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="collapse" id="removePanel-{{ $donation->id }}">
                                    <div class="well">
                                        <form class="form-vertical" method="POST" action="{{ url('donazione/' . $donation->id) }}">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="holder" class="control-label">Motivo</label>
                                                <select class="form-control" name="reason">
                                                    @foreach(App\Donation::declineReasons() as $identifier => $reason)
                                                    <option value="{{ $identifier }}">{{ $reason->text }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default">Elimina</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
