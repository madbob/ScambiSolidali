@extends('layouts.app')

@section('content')

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('donazione') }}">Oggetti</a></li>
                <li><a href="{{ url('fruitore') }}">Fruitori</a></li>
                <li><a href="{{ url('archivio') }}">Archivio</a></li>
                <li><a href="{{ url('appello') }}">Appelli</a></li>

                @if(Auth::user()->role == 'admin')
                    <li><a href="{{ url('utente') }}">Utenti &amp; Enti</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('acontent')

@endsection
