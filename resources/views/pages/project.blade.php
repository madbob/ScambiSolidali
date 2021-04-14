@extends('layouts.app')

@section('title', 'Il Progetto')

@section('content')
    <div class="project">
        <div class="row primary-1">
            <div class="pagetitle">
                <span>{{ t('IL PROGETTO') }}</span>
            </div>

            {!! App\Config::getConf('project_page') !!}
        </div>
    </div>
@endsection
