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
                                        @include('donation.assign', ['donation' => $donation])
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
