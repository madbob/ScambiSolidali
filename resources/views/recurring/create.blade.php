@extends('layouts.mini')

@section('content')

<script>
var selectable_categories = {{ json_encode(App\Recurring::categories()) }};
</script>

@if($call->filled)
    <div class="alert alert-info">
        Questa richiesta è già stata compilata {{ printableDate($call->updated_at) }}. Salvando questo form, andrai a sovrascrivere le informazioni esistenti.
    </div>
@endif

<form method="POST" action="{{ route('periodico.store') }}">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{ $call->identifier }}">
    <input type="hidden" name="type" value="{{ $call->company->donation_frequency }}">

    <ul class="list-group">
        <li class="list-group-item list-group-item-danger checklist-filling-row boolean-select">
            <div class="row">
                <div class="col-md-6">
                    <p>Hai qualcosa da donarci?</p>
                </div>
                <div class="col-md-6">
                    <div class="btn-group btn-group-toggle btn-group-lg float-right" data-toggle="buttons">
                        <label class="btn btn-light">
                            <input type="radio" name="having" value="true" autocomplete="off"> SI
                        </label>
                        <label class="btn btn-danger active">
                            <input type="radio" name="having" value="false" autocomplete="off" checked> NO
                        </label>
                    </div>
                </div>
            </div>
        </li>

        @if($call->company->donation_frequency == 'weekly')
            <li class="list-group-item list-group-item-danger checklist-filling-row quantity-select">
                <div class="row">
                    <div class="col-md-6">
                        <p>Se si, quanti box hai?</p>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group btn-group-toggle btn-group-lg float-right" data-toggle="buttons">
                            @for($i = 1; $i < 7; $i++)
                                <label class="btn btn-light">
                                    <input type="radio" name="boxes" value="{{ $i }}" autocomplete="off"> {{ $i }}
                                </label>
                            @endfor
                        </div>
                    </div>
                </div>
            </li>
        @elseif($call->company->donation_frequency == 'monthly')
            <li class="list-group-item list-group-item-danger checklist-filling-row types-select">
                <div class="row">
                    <div class="col-md-6">
                        <select name="type[]" class="form-control type-select">
                            <option value="no">Seleziona una Categoria</option>
                            @foreach(App\Recurring::categories() as $cat)
                                <option value="{{ $cat->label }}">{{ $cat->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 custom-quantity">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success add-type">Aggiungi</button>
                    </div>
                </div>
            </li>
        @endif

        <li class="list-group-item list-group-item-default checklist-filling-row">
            <div class="row">
                <div class="col-md-6">
                    <p>Note</p>
                </div>
                <div class="col-md-6">
                    <textarea class="form-control form-control-lg" name="notes" autocomplete="false"></textarea>
                </div>
            </div>
        </li>

        <li class="list-group-item list-group-item-default checklist-filling-row">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg">Invia</button>
                </div>
            </div>
        </li>
    </ul>

    <br>
</form>

@endsection
