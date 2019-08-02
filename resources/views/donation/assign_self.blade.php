<form class="form-horizontal" method="POST" action="{{ url('donazione/assegna/' . $donation->id) }}">
    {{ csrf_field() }}
    <input type="hidden" name="assignation_type" value="self">

    <div class="form-group">
        <label for="message" class="col-md-4 control-label">Messaggio</label>
        <div class="col-sm-8">
            <textarea name="message" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">Salva</button>
    </div>
</form>
