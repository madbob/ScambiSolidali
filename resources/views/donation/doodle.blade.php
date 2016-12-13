@extends('layouts.app')

@section('title', 'Disponibilità Recupero Donazione')

@section('content')

<div class="row">
    <div class="col-md-12">
        <p>
            Seleziona i giorni e gli orari in cui sei disponibile per il recupero dell'oggetto donato.
        </p>
        <p>
            Sarai contattato telefonicamente per maggiori dettagli.
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr/>

        <form method="POST" action="{{ url('donazione/' . $donation->id) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="PUT">

            <table class="table text-center">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <?php $d = Date::now() ?>
                        @for($i = 0; $i < 7; $i++)
                            <?php $d = $d->add('1 day') ?>
                            <th class="text-center">{{ $d->format('l d') }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach([9, 12, 15, 18] as $hour)
                        <tr>
                            <td>{{ $hour . ':00' }}</td>
                            <?php $d = Date::now() ?>
                            @for($i = 0; $i < 7; $i++)
                                <?php $d = $d->add('1 day') ?>
                                <td><input type="checkbox" name="availability[]" value="{{ $d->format('d m') . ' ' . $hour }}"></td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary pull-right">Salva</button>
        </form>
    </div>
</div>

@endsection
