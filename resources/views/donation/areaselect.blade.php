@if(App\Config::getConf('instance_city') == 'Torino')
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
@elseif(App\Config::getConf('instance_city') == 'Milano')
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
