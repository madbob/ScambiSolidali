<div class="modal fade donation-modal" id="info-{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="info">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ $donation->category ? $donation->category->name : '???' }} | {{ $donation->title }}</h4>
                <p class="text-muted"><small><br>{{ url('/celo?show=' . $donation->id) }}</small></p>
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
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @include('donation.sameuser', ['donation' => $donation])

                            @if($donation->receivers->isEmpty() == false)
                                <hr/>
                                @include('donation.minilist', ['list' => $donation->receivers, 'print_object' => false])
                            @endif

                            @if($donation->status == 'pending')
                                <hr/>
                                <button class="btn btn-success" role="button" data-toggle="collapse" href="#assignPanel-{{ $donation->id }}" aria-expanded="false" aria-controls="assignPanel-{{ $donation->id }}">Richiedi l'Oggetto</button>

                                @if($currentuser->role == 'admin' || $currentuser->role == 'operator')
                                    <button class="btn btn-danger" role="button" data-toggle="collapse" href="#removePanel-{{ $donation->id }}" aria-expanded="false" aria-controls="removePanel-{{ $donation->id }}">Elimina</button>

                                    <div class="collapse" id="assignPanel-{{ $donation->id }}">
                                        <div class="well">
                                            <div class="alert alert-info">
                                                Indica qui alcuni dati relativi al beneficiario della donazione, a seconda che sia una persona o un ente.
                                            </div>

                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#assign-user-{{ $donation->id }}" aria-controls="assign-user-{{ $donation->id }}" role="tab" data-toggle="tab">Persona</a></li>
                                                <li role="presentation"><a href="#assign-organization-{{ $donation->id }}" aria-controls="assign-organization-{{ $donation->id }}" role="tab" data-toggle="tab">Ente</a></li>
                                            </ul>

                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="assign-user-{{ $donation->id }}">
                                                    <br>
                                                    @include('donation.assign_user', ['donation' => $donation])
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="assign-organization-{{ $donation->id }}">
                                                    <br>
                                                    @include('donation.assign_org', ['donation' => $donation])
                                                </div>
                                            </div>
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
                                @elseif(env('HAS_PUBLIC_OP', false) && $currentuser->role == 'student')
                                    <div class="collapse" id="assignPanel-{{ $donation->id }}">
                                        <div class="well">
                                            @include('donation.assign_self', ['donation' => $donation])
                                        </div>
                                    </div>
                                @endif
                            @elseif($donation->status == 'expiring' || $donation->status == 'expired')
                                <hr/>
                                <form class="form-vertical" method="POST" action="{{ url('celo/arenew/' . $donation->id) }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success" role="button">Rinnova</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
