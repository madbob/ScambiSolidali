<?php $role = Auth::user()->role ?>

<div class="modal fade donation-modal" id="info-{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="info">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ $donation->category->name }} | {{ $donation->title }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        @for($i = 1; $i <= $donation->imagesNum(); $i++)
                            <img src="{{ $donation->imageUrl($i) }}" class="img-responsive">
                        @endfor
                    </div>
                    <div class="col-md-offset-1 col-md-6">
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
                    </div>

                    @if($role == 'admin' || $role == 'operator')
                        <div class="row">
                            <div class="col-md-12">
                                @if($donation->receivers->isEmpty() == false)
                                    <hr/>
                                    @include('donation.minilist', ['list' => $donation->receivers, 'print_object' => false])
                                @endif

                                @if($donation->status == 'pending')
                                    <hr/>
                                    <button class="btn btn-success" role="button" data-toggle="collapse" href="#assignPanel-{{ $donation->id }}" aria-expanded="false" aria-controls="assignPanel-{{ $donation->id }}">Oggetto Assegnato</button> <button class="btn btn-danger" role="button" data-toggle="collapse" href="#removePanel-{{ $donation->id }}" aria-expanded="false" aria-controls="removePanel-{{ $donation->id }}">Elimina</button>
                                @endif

                                <div class="collapse" id="assignPanel-{{ $donation->id }}">
                                    <div class="well">
                                        <form class="form-horizontal" method="POST" action="{{ url('donazione/assegna/' . $donation->id) }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="receiver-age" class="col-sm-4 control-label">Età</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="receiver-age" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="receiver-gender" class="col-sm-4 control-label">Sesso</label>
                                                <div class="col-sm-8">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-gender" value="M"> Maschile
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-gender" value="F"> Femminile
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="receiver-status" class="col-sm-4 control-label">Stato</label>
                                                <div class="col-sm-8">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-status" value="employed"> Occupato
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-status" value="unemployed"> Non occupato
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="receiver-children" class="col-sm-4 control-label">Famiglia</label>
                                                <div class="col-sm-8">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-children" value="children"> Ha figli
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-children" value="nochildren"> Non ha figli
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="receiver-area" class="col-sm-4 control-label">Residenza</label>
                                                <div class="col-sm-4">
                                                    @for($i = 1; $i < 6; $i++)
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" name="receiver-area" value="circ{{ $i }}"> Circoscrizione {{ $i }}
                                                            </label>
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div class="col-sm-4">
                                                    @for(; $i < 9; $i++)
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" name="receiver-area" value="circ{{ $i }}"> Circoscrizione {{ $i }}
                                                            </label>
                                                        </div>
                                                    @endfor
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-area" value="other"> Altro
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="receiver-country" class="col-sm-4 control-label">Cittadinanza</label>
                                                <div class="col-sm-8">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-country" value="italian"> Italiana
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="receiver-country" value="nonitalian"> Straniera
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="receiver-past" class="col-sm-4 control-label">Quante volte ha fruito di Celocelo?</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="receiver-past" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="notes" class="col-md-4 control-label">Note Private</label>
                                                <div class="col-sm-8">
                                                    <textarea name="notes" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="receiver-country" class="col-sm-4 control-label">Richiedi Trasporto</label>
                                                <div class="col-sm-8">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="shipping">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default">Salva</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="collapse" id="removePanel-{{ $donation->id }}">
                                    <div class="well">
                                        <form class="form-vertical" method="POST" action="{{ url('celo/' . $donation->id) }}">
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
