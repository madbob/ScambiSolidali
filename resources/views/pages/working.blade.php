@extends('layouts.app')

@section('title', 'Come Funziona')

@section('content')
    <div class="working">
        <div class="row primary-2">
            <div class="pagetitle">
                <span>COME FUNZIONA</span>
            </div>
        </div>

        {!! App\Config::getConf('working_description') !!}
    </div>
@endsection
