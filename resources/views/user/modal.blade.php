<div class="modal fade primary-1" id="user-{{ $user ? $user->id : 'new' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Utente</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical(['model' => $user, 'store' => 'giocatori.store', 'update' => 'giocatori.update']) !!}
                            {!! BootForm::text('name', 'Nome') !!}
                            {!! BootForm::text('surname', 'Cognome') !!}
                            {!! BootForm::text('phone', 'Telefono') !!}
                            {!! BootForm::email() !!}
                            {!! BootForm::password('password', 'Password', ['help_text' => 'Lascia vuoto per non modificare la password']) !!}
                            {!! BootForm::radios('role', 'Ruolo', [
                                'admin' => 'Amministratore',
                                'operator' => 'Operatore',
                                'user' => 'Utente'
                            ]) !!}

                            <?php
                                $institutes = [];
                                foreach(App\Institute::orderBy('name', 'asc')->get() as $institute)
                                $institutes[$institute->id] = $institute->name;
                            ?>

                            @if(!empty($institutes))
                                {!! BootForm::checkboxes('institutes[]', 'Affiliazioni', $institutes, $user ? $user->institutes->reduce(function($carry, $item) {
                                    $carry[] = $item->id;
                                    return $carry;
                                }, []) : []) !!}
                            @endif

                            <div class="form-group">
                                <div>
                                    <button class="button" type="submit">
                                        <span>Salva</span>
                                    </button>
                                </div>
                            </div>
                        {!! BootForm::close() !!}

                        @if($user)
                            <div class="form-group">
                                <button class="btn btn-danger" role="button" data-toggle="collapse" href="#destroyUser-{{ $user->id }}" aria-expanded="false" aria-controls="#destroyUser-{{ $user->id }}">Elimina</button>

                                <div class="collapse" id="destroyUser-{{ $user->id }}">
                                    <div class="well">
                                        <form class="form-vertical" method="POST" action="{{ url('giocatori/' . $user->id) }}">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ csrf_field() }}

                                            <div class="alert alert-danger">
                                                Sei sicuro di voler eliminare questo utente? Tutte le sue donazioni saranno eliminate.
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
