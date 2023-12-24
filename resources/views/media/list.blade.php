@extends('layouts.app')

@section('title', 'Parlano di Noi')

@section('content')
    <div class="journal">
        <div class="row primary-1">
            <div class="pagetitle">
                <span>PARLANO DI NOI</span>
            </div>
        </div>

        @if($edit_enabled)
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-default" data-toggle="modal" data-target="#media-new">Crea Nuovo Riferimento</button>
                    @include('media.modal', ['media' => null, 'context' => 'media'])
                </div>
            </div>
        @endif

        <div class="row primary-4">
            @foreach($media as $m)
                <a href="{{ $m->link }}" target="_blank">
                    <div class="col-md-3 dense-fancy-bg square-block">
                        <div class="content">
                            <span class="top">{{ $m->channel }}</span>
                            <span class="bottom">{{ date('d.m.Y', strtotime($m->date)) }}</span>

                            @if($edit_enabled)
                                <button class="btn btn-default" data-toggle="modal" data-target="#media-{{ $m->id }}">Modifica</button>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    @if($edit_enabled)
        @foreach($media as $m)
            @include('media.modal', ['media' => $m])
        @endforeach
    @endif
@endsection
