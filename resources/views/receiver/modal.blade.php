<div class="modal fade" id="receiver-{{ $receiver->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Fruitore</h4>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! BootForm::horizontal(['model' => $receiver, 'store' => 'fruitore.store', 'update' => 'fruitore.update']) !!}
                            {!! BootForm::text('name', 'Nome') !!}
                            {!! BootForm::text('surname', 'Cognome') !!}
                            {!! BootForm::text('address', 'Indirizzo') !!}
                            {!! BootForm::text('phone', 'Telefono') !!}
                            {!! BootForm::email() !!}
                            {!! BootForm::textarea('notes', 'Note') !!}
                            {!! BootForm::submit('Salva') !!}
                        {!! BootForm::close() !!}
                    </div>
                    <div class="col-md-6">
                        @include('donation.minilist', ['list' => $receiver->donations, 'print_receiver' => false, 'print_object' => true])
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
