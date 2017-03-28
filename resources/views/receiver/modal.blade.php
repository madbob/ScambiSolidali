<div class="modal fade" id="receiver-{{ $receiver ? $receiver->id : 'new' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Fruitore</h4>
            </div>


            <div class="modal-body">
                <div class="row">
                    @if($receiver)
                    <div class="col-md-6">
                    @else
                    <div class="col-md-12">
                    @endif
                        {!! BootForm::vertical(['model' => $receiver, 'store' => 'fruitore.store', 'update' => 'fruitore.update']) !!}
                            {!! BootForm::text('name', 'Nome') !!}
                            {!! BootForm::text('surname', 'Cognome') !!}
                            {!! BootForm::text('address', 'Indirizzo') !!}
                            {!! BootForm::text('phone', 'Telefono') !!}
                            {!! BootForm::email() !!}
                            {!! BootForm::textarea('notes', 'Note') !!}

                            <div class="form-group">
                                <div>
                                    <button class="button" type="submit">
                                        <span>Salva</span>
                                    </button>
                                </div>
                            </div>
                        {!! BootForm::close() !!}
                    </div>

                    @if($receiver)
                        <div class="col-md-6">
                            @include('donation.minilist', ['list' => $receiver->donations, 'print_receiver' => false, 'print_object' => true])
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
