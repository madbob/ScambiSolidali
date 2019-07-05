@extends('layouts.mini')

@section('content')

<script>
var selectable_categories = {!! json_encode(App\Recurring::categories()) !!};
</script>

@if($call->filled)
    <div class="alert alert-info">
        Questa richiesta è già stata compilata {{ printableDate($call->updated_at) }}. Salvando questo form, andrai a sovrascrivere le informazioni esistenti.
    </div>
@endif

<form method="POST" action="{{ route('periodico.store') }}">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{ $call->identifier }}">
    <input type="hidden" name="recurring_type" value="{{ $call->company->donation_frequency }}">

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
                        <p>Se si, quanti vaschette hai?</p>
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

            <li class="list-group-item list-group-item-default checklist-filling-row">
                <div class="row">
                    <div class="col-md-6">
                        <p>Puoi indicarci che tipo di cibo doni?</p>
                    </div>
                    <div class="col-md-6">
                        <textarea class="form-control form-control-lg" name="comment" autocomplete="false"></textarea>
                    </div>
                </div>
            </li>
        @elseif($call->company->donation_frequency == 'monthly')
            <li class="list-group-item list-group-item-danger checklist-filling-row types-select">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="30%">Categoria</th>
                                <th width="70%">Chili/Litri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Recurring::categories() as $cat)
                                <tr>
                                    <td>{{ $cat->label }}</td>
                                    <td>
                                        <input type="hidden" name="type[]" value="{{ $cat->identifier }}">
                                        <input type="number" class="form-control" name="quantity[]" value="0">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
