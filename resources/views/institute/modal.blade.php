<div class="modal fade primary-1" id="institute-{{ $institute ? $institute->id : 'new' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ente</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical(['model' => $institute, 'store' => 'ente.store', 'update' => 'ente.update']) !!}
                            {!! BootForm::text('name', 'Nome') !!}
                            {!! BootForm::text('website', 'Sito Web') !!}

                            @if(env('HAS_FOOD', false))
                                {!! BootForm::checkbox('food', 'Abilitato per Food') !!}
                            @endif

                            <div class="form-group">
                                <label for="address" class="control-label">Indirizzo</label>
                                <div>
                                    <input type="hidden" name="address" value="{{ $institute ? $institute->address : '' }}">
                                    <input type="hidden" name="coordinates" value="{{ $institute ? ($institute->lat . ',' . $institute->lng) : '' }}">
                                    <div class="map-select" id="institute-address-selection-{{ $institute ? $institute->id : 'new' }}"></div>
                                    <span class="help-block">Attenzione: digita un indirizzo e selezionalo dal menu di autocompletamento. Se l'indirizzo non viene completato in questo modo, non sarà possibile risalire alle coordinate desiderate</span>
                                </div>
                            </div>

                            {!! BootForm::staticfield('code', 'Codice', $institute ? $institute->code : ($code = Illuminate\Support\Str::random(10)), ['help_text' => 'Questo è il codice che gli operatori devono usare nell\'apposito pannello di registrazione per essere accreditati a questo ente', 'disabled' => 'disabled']) !!}
                            @if($institute == null)
                                <input type="hidden" name="code" value="{{ $code }}">
                            @endif

                            {!! BootForm::text('transport_mail', 'Indirizzo EMail per Trasporto', null, ['help_text' => "Se specificato, quando un operatore di questo Ente chiede il trasporto di una donazione l'email di notifica viene inviata qui anziché agli amministratori"]) !!}

                            <br/>

                            <div class="form-group">
                                <div>
                                    <button class="button" type="submit">
                                        <span>Salva</span>
                                    </button>
                                </div>
                            </div>
                        {!! BootForm::close() !!}

                        @if($institute)
                            <div class="form-group">
                                <label class="control-label">Operatori</label>
                                @if($institute->users->isEmpty())
                                    <div class="alert alert-info">
                                        Non ci sono operatori registrati per questa associazione.
                                    </div>
                                @else
                                    <table class="table">
                                        <tbody>
                                            @foreach($institute->users as $u)
                                                <tr>
                                                    <td>{{ $u->printableName() }}</td>
                                                    <td>{{ $u->email }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-danger" role="button" data-toggle="collapse" href="#destroyUser-{{ $institute->id }}" aria-expanded="false" aria-controls="#destroyUser-{{ $institute->id }}">Elimina</button>

                                <div class="collapse" id="destroyUser-{{ $institute->id }}">
                                    <div class="well">
                                        <form class="form-vertical" method="POST" action="{{ url('ente/' . $institute->id) }}">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ csrf_field() }}

                                            <div class="alert alert-danger">
                                                Sei sicuro di voler eliminare questa associazione?
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default">Si, elimina</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
