@extends('layouts.app')

@section('title', 'Il Progetto')

@section('content')
    <div class="project">
        <div class="row primary-1">
            <div class="pagetitle">
                <span>{{ t('IL PROGETTO') }}</span>
            </div>

            @include('customs.' . currentInstance() . '.project')
        </div>
    </div>
@endsection
