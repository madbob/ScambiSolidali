<div class="modal fade" id="user-{{ $user->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Utente</h4>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::horizontal(['model' => $user, 'store' => 'utente.store', 'update' => 'utente.update']) !!}
                            {!! BootForm::text('name', 'Nome') !!}
                            {!! BootForm::text('surname', 'Cognome') !!}
                            {!! BootForm::text('phone', 'Telefono') !!}
                            {!! BootForm::email() !!}
                            {!! BootForm::radios('role', 'Ruolo', ['admin' => 'Amministratore', 'operator' => 'Operatore', 'user' => 'Donatore'], 'user') !!}
                            {!! BootForm::password('password', 'Password', ['help_text' => 'Lascia vuoto per non modificare la password']) !!}
                            {!! BootForm::submit('Salva') !!}
                        {!! BootForm::close() !!}
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
