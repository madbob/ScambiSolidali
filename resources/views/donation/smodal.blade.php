<div class="modal fade" id="info-{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="info">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ $donation->category->name }} | {{ $donation->title }}</h4>
                <p class="text-muted"><small><br>{{ url('/celo?show=' . $donation->id) }}</small></p>
            </div>
            <div class="modal-body primary-1">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal">
                            @include('donation.info', ['donation' => $donation])
                        </form>
                    </div>

                    @if($currentuser->role == 'admin' || $currentuser->role == 'operator')
                        <div class="row">
                            <div class="col-md-12">
                                @include('donation.sameuser', ['donation' => $donation])

                                @if($donation->receivers->isEmpty() == false)
                                    <hr/>
                                    @include('donation.minilist', ['list' => $donation->receivers, 'print_object' => false])
                                @endif

                                @if($donation->status == 'pending')
                                    <hr/>
                                    <button class="btn btn-success" role="button" data-toggle="collapse" href="#assignPanel-{{ $donation->id }}" aria-expanded="false" aria-controls="assignPanel-{{ $donation->id }}">Servizio Assegnato</button> <button class="btn btn-danger" role="button" data-toggle="collapse" href="#removePanel-{{ $donation->id }}" aria-expanded="false" aria-controls="removePanel-{{ $donation->id }}">Elimina</button>
                                @endif

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
                            </div>
                        </div>
                    @endif
                </div>

                @if (env('HAS_PUBLIC_OP', false))
                    <div class="row">
                        <div class="col-md-12">
                            <hr>

                            <p class="form-control-static">
                                <small>Da qui puoi metterti in contatto con chi offre questo servizio: scrivi la tua richiesta ed inviala da qui. Il donatore riceverà il tuo nome ed il tuo indirizzo email per mettersi nuovamente in contatto con te.</small>
                            </p>

                            <form class="form-horizontal" method="POST" action="{{ route('donation.contact', $donation->id) }}">
                                {!! csrf_field() !!}

                                {!! BootForm::textarea('request', 'La tua Richiesta', null, ['required' => 'required']) !!}

                                <div class="form-group">
                                    <div>
                                        <button class="button" type="submit">
                                            <span>Invia Richiesta!</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
