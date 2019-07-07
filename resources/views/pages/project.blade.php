@extends('layouts.app')

@section('title', 'Il Progetto')

@section('content')
    <div class="project">
        <div class="row primary-1">
            <div class="pagetitle">
                <span>IL PROGETTO</span>
            </div>

            <div class="col-md-3">
                <div class="common-card">
                    <div class="card-main image-frame" style="background-image: url('{{ url('images/categories/casa_elettrodomestici.svg') }}')">
                        &nbsp;
                    </div>
                    <div class="card-footer vert-align">
                        <p>
                            {{ env('APP_NAME') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                {!! App\Config::getConf('project_description') !!}

                <div class="col-md-6 right-p">
                    <p class="border-bottom">
                        &nbsp;
                    </p>
                </div>
                <div class="col-md-6 left-p">
                    <p class="border-bottom">
                        &nbsp;
                    </p>
                </div>
                <div class="col-md-12 credits">
                    {!! App\Config::getConf('full_credits') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
