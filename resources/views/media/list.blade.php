@extends('layouts.app')

@section('title', 'Parlano di Noi')

@section('content')
    <div class="journal">
        <div class="row primary-1">
            <div class="col">
                <div class="pagetitle">
                    <span>PARLANO DI NOI</span>
                </div>
            </div>
        </div>

        @if($edit_enabled)
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#media-new">Crea Nuovo Riferimento</button>
                    @include('media.modal', ['media' => null, 'context' => 'media'])
                </div>
            </div>
        @endif

        <div class="row primary-4 row-cols-1 row-cols-md-4 g-4">
            @foreach($media as $m)
                <div class="col">
                    <div class="card dense-fancy-bg square-block w-100">
                        <div class="content">
                            <span class="top">
                                <a href="{{ $m->link }}" class="text-black" target="_blank">
                                    {{ $m->channel }}
                                </a>
                            </span>
                            <span class="bottom">{{ date('d.m.Y', strtotime($m->date)) }}</span>

                            @if($edit_enabled)
                                <button class="btn btn-default" data-bs-toggle="modal" data-bs-target="#media-{{ $m->id }}">Modifica</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($edit_enabled)
        @foreach($media as $m)
            @include('media.modal', ['media' => $m])
        @endforeach
    @endif
@endsection
