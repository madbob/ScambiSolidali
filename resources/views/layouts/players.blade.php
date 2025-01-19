@extends('layouts.app')

@section('title', t('Giocatori'))

@section('content')
    <input type="hidden" name="trigger-show-details" data-endpoint="giocatori" data-item-id="{{ $current_show ?? -1 }}">

    <div class="players primary-1">
        <div class="row">
            @if($currentuser && $currentuser->role == 'admin')
                <div class="col">
                    <a href="{{ route('giocatori.index') }}" class="pagetitle">
                        <span>Associazioni</span>
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('utenti.index') }}" class="pagetitle">
                        <span>Utenti</span>
                    </a>
                </div>
            @else
                <div class="col">
                    <div class="pagetitle">
                        <span>Associazioni</span>
                    </div>
                </div>
            @endif
        </div>

        @yield('contents')
    </div>
@endsection
