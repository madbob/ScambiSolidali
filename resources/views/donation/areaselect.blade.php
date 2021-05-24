<?php $current_instance = App\Config::getConf('instance_city') ?>

@if($current_instance == 'Torino')
    <div class="col-sm-4">
        @for($i = 1; $i < 6; $i++)
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-area" value="circ{{ $i }}" required> Circoscrizione {{ $i }}
                </label>
            </div>
        @endfor
    </div>
    <div class="col-sm-4">
        @for(; $i < 9; $i++)
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-area" value="circ{{ $i }}" required> Circoscrizione {{ $i }}
                </label>
            </div>
        @endfor
        <div class="checkbox">
            <label>
                <input type="radio" name="receiver-area" value="other" required> Altro
            </label>
        </div>
        <input type="text" name="receiver-area-other" class="form-control">
    </div>
@elseif($current_instance == 'Milano')
    <div class="col-sm-4">
        @for($i = 1; $i < 6; $i++)
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-area" value="municipio{{ $i }}" required> Milano / Municipio {{ $i }}
                </label>
            </div>
        @endfor
    </div>
    <div class="col-sm-4">
        @for(; $i < 10; $i++)
            <div class="checkbox">
                <label>
                    <input type="radio" name="receiver-area" value="municipio{{ $i }}" required> Milano / Municipio {{ $i }}
                </label>
            </div>
        @endfor
        <div class="checkbox">
            <label>
                <input type="radio" name="receiver-area" value="other" required> Altro
            </label>
        </div>
        <input type="text" name="receiver-area-other" class="form-control">
    </div>
@elseif($current_instance == 'Trentino')
    <div class="col-sm-4">
        <div class="checkbox">
            <label>
                <input type="radio" name="receiver-area" value="COMUNITA' TERRITORIALE DELLA VAL DI FIEMME" required> COMUNITA' TERRITORIALE DELLA VAL DI FIEMME
                <input type="radio" name="receiver-area" value="COMUNITA' DI PRIMIERO" required> COMUNITA' DI PRIMIERO
                <input type="radio" name="receiver-area" value="COMUNITA' VALSUGANA E TESINO" required> COMUNITA' VALSUGANA E TESINO
                <input type="radio" name="receiver-area" value="COMUNITA' ALTA VALSUGANA E BERSNTOL" required> COMUNITA' ALTA VALSUGANA E BERSNTOL
                <input type="radio" name="receiver-area" value="COMUNITA' DELLA VALLE DI CEMBRA" required> COMUNITA' DELLA VALLE DI CEMBRA
                <input type="radio" name="receiver-area" value="COMUNITA' DELLA VAL DI NON" required> COMUNITA' DELLA VAL DI NON
            </label>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="checkbox">
            <label>
                <input type="radio" name="receiver-area" value="COMUNITA' DELLA VALLE DI SOLE" required> COMUNITA' DELLA VALLE DI SOLE
                <input type="radio" name="receiver-area" value="COMUNITA' DELLE GIUDICARIE" required> COMUNITA' DELLE GIUDICARIE
                <input type="radio" name="receiver-area" value="COMUNITA' ALTO GARDA E LEDRO" required> COMUNITA' ALTO GARDA E LEDRO
                <input type="radio" name="receiver-area" value="COMUNITA' DELLA VALLAGARINA" required> COMUNITA' DELLA VALLAGARINA
                <input type="radio" name="receiver-area" value="COMUN GENERAL DE FASCIA" required> COMUN GENERAL DE FASCIA
                <input type="radio" name="receiver-area" value="MAGNIFICA COMUNITA' DEGLI ALTIPIANI CIMBRI" required> MAGNIFICA COMUNITA' DEGLI ALTIPIANI CIMBRI
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="radio" name="receiver-area" value="COMUNITA' ROTALIANA - KONIGSBERG" required> COMUNITA' ROTALIANA - KONIGSBERG
                <input type="radio" name="receiver-area" value="COMUNITA' DELLA PAGANELLA" required> COMUNITA' DELLA PAGANELLA
                <input type="radio" name="receiver-area" value="COMUNITA' DELLA VALLE DEI LAGHI" required> COMUNITA' DELLA VALLE DEI LAGHI
                <input type="radio" name="receiver-area" value="TRENTO" required> TRENTO
                <input type="radio" name="receiver-area" value="ROVERETO" required> ROVERETO
                <input type="radio" name="receiver-area" value="other" required> Altro
            </label>
        </div>
        <input type="text" name="receiver-area-other" class="form-control">
    </div>
@else
    <div class="col-sm-4">
        <div class="checkbox">
            <label>
                <input type="radio" name="receiver-area" value="other" checked required> Altro
            </label>
        </div>
        <input type="text" name="receiver-area-other" class="form-control">
    </div>
@endif
