<div class="modal fade primary-1" id="company-{{ $company ? $company->id : 'new' }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Azienda</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! BootForm::vertical(['model' => $company, 'store' => 'azienda.store', 'update' => 'azienda.update']) !!}
                            {!! BootForm::text('name', 'Nome') !!}
                            {!! BootForm::text('phone', 'Telefono') !!}
                            {!! BootForm::email() !!}
                            {!! BootForm::text('website', 'Sito Web') !!}

                            <div class="form-group">
                                <label for="address" class="control-label">Indirizzo</label>
                                <div>
                                    <input type="hidden" name="address" value="{{ $company ? $company->address : '' }}">
                                    <input type="hidden" name="coordinates" value="{{ $company ? ($company->lat . ',' . $company->lng) : '' }}">
                                    <div class="map-select" id="company-address-selection-{{ $company ? $company->id : 'new' }}"></div>
                                    <span class="help-block">Attenzione: digita un indirizzo e selezionalo dal menu di autocompletamento. Se l'indirizzo non viene completato in questo modo, non sarà possibile risalire alle coordinate desiderate</span>
                                </div>
                            </div>

                            {!! BootForm::radios('donation_frequency', 'Donazione', [
                                'none' => 'Nessuna',
                                'weekly' => 'Settimanale',
                                'monthly' => 'Mensile',
                            ]) !!}

                            <div class="form-group">
                                <div>
                                    <button class="button" type="submit">
                                        <span>Salva</span>
                                    </button>
                                </div>
                            </div>
                        {!! BootForm::close() !!}

                        @if($company)
                            <div class="form-group">
                                <label class="<<control-label">Operatori</label>
                                @if($company->users->isEmpty())
                                    <div class="alert alert-info">
                                        Non ci sono operatori registrati per questa azienda.
                                    </div>
                                @else
                                    <table class="table">
                                        <tbody>
                                            @foreach($company->users as $u)
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
                                <button class="btn btn-danger" role="button" data-toggle="collapse" href="#destroyCompany-{{ $company->id }}" aria-expanded="false" aria-controls="#destroyCompany-{{ $company->id }}">Elimina</button>

                                <div class="collapse" id="destroyCompany-{{ $company->id }}">
                                    <div class="well">
                                        <form class="form-vertical" method="POST" action="{{ url('azienda/' . $company->id) }}">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ csrf_field() }}

                                            <div class="alert alert-danger">
                                                Sei sicuro di voler eliminare questo azienda? Tutte le sue donazioni saranno eliminate.
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
