@extends('layouts.app')

@section('title', 'Food')

@section('content')
    <div class="project">
        <div class="row primary-6">
            <div class="pagetitle">
                <span>FOOD</span>
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
                <div class="col-md-6 right-p">
                    <p>
                        <strong>Food</strong> mette in contatto chi opera nel sociale con chi ha qualcosa da mangiare!
                    </p>
                </div>
                <div class="col-md-6 left-p">
                    <p>
                        ...
                    </p>
                </div>
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
                <div class="col-md-12">
                    <p>
                        Soggetti coinvolti:
                    </p>
                    <ul>
                        @foreach(App\Company::orderBy('name')->get() as $company)
                            <li>{{ $company->name }}</li>
                        @endforeach
                    </ul>
                    <p>
                        Se anche tu vuoi essere parte del progetto, <a href="{{ route('contacts') }}">contattaci!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
