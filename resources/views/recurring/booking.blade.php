@extends('layouts.app')

@section('title', 'Prenotazione Periodica')

@section('content')
    <div class="celo primary-1">
        @foreach($currentuser->institutes as $institute)
            <form method="POST" action="{{ route('periodico.prenotazione') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="institute_id" value="{{ $institute->id }}">

            	<div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h3>{{ $institute->name }}</h3>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="20%">Prodotto</th>
                                    <th width="20%">Donato<br><small>(Chili/Litri)</small></th>
                                    <th width="20%">Già Prenotato<br><small>(Chili/Litri)</small></th>
                                    <th width="20%">Disponibile<br><small>(Chili/Litri)</small></th>
                                    <th width="20%">Quantità Prenotata<br><small>(Chili/Litri)</small></th>
                                </tr>
                            </thead>
                            <tbody>
                				@foreach($data as $product => $metadata)
                                    <?php $still = $metadata->donated - $metadata->required ?>
                                    <tr>
                                        <td>{{ $metadata->label }}</td>
                                        <td>{{ $metadata->donated }}</td>
                                        <td>{{ $metadata->required }}</td>
                                        <td>{{ $still }}</td>
                                        <td>
                                            <input type="hidden" name="type[]" value="{{ $product }}">
                                            @if($still <= 0)
                                                <input type="hidden" name="quantity[]" value="0">
                                                Non Disponibile
                                            @else
                                                <input type="number" class="form-control" name="quantity[]" value="0" min="0" max="{{ $still }}">
                                            @endif
                                        </td>
                                    </tr>
                				@endforeach
                            </tbody>
                        </table>
            		</div>
            	</div>

                <hr>

                <div class="form-group">
                    <div>
                        <button class="button" type="submit">
                            <span>Salva</span>
                        </button>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
@endsection
