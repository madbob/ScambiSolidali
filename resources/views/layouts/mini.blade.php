<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pagetitle }}</title>

    {!! Minify::stylesheet('/css/app.css') !!}

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app" class="mini-layout">
        @if(Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

    	@yield('content')

        <br/>
    </div>

    <script src="{{ url('js/app.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.it.min.js') }}"></script>
    {!! Minify::javascript('/js/mine.js') !!}
</body>
</html>
