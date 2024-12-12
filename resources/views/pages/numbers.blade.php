@extends('layouts.app')

@section('title', 'Numeri')

@section('content')
    <div class="numbers primary-2">
        <div class="row">
            <div class="col-12">
                <div class="pagetitle">
                    <span class="text-uppercase">{{ t('Storie a lieto fine') }}</span>
                </div>
            </div>

            @php

            $donated = App\Donation::whereIn('status', ['pending', 'assigned'])->count();
            $donated_width = 70;
            if ($donated != 0) {
                $assigned = App\Donation::where('status', 'assigned')->count();
                $assigned_width = (70 * $assigned) / $donated;
            }

            @endphp

            @if($donated != 0)
                <div class="col-12">
                    <div class="metric">
                        <p class="name txt-color">
                            Oggetti Inseriti
                        </p>
                        <div class="bar">
                            <div class="indicator" style="width: {{ $donated_width }}%">&nbsp;</div>
                            <span class="txt-color">{{ $donated }}</span>
                        </div>
                    </div>
                    <div class="metric">
                        <p class="name txt-color">
                            Oggetti Assegnati
                        </p>
                        <div class="bar">
                            <div class="indicator" style="width: {{ $assigned_width }}%">&nbsp;</div>
                            <span class="txt-color">{{ $assigned }}</span>
                        </div>
                    </div>
                </div>

                <p class="clearfix">&nbsp;</p>
                <hr class="colored">
            @endif
        </div>

        @php
        $max_absolute = array_sum($categories);
        $max_relative = max($categories);
        @endphp

        @if($max_absolute != 0)
            <div class="row d-flex justify-content-center">
                @foreach($categories as $name => $count)
                    <div class="col-12 col-md-2">
                        <div class="item progress-{{ round(($count * 100) / $max_relative, 0) }}">
                            <div class="radial-inner-bg">
                                <div>
                                    <p class="percentage">{{ round(($count * 100) / $max_absolute, 0) }}%</p>
                                    <p>{{ $name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if(App\Story::count() > 0 || $edit_enabled)
        <br>

        <div class="stories primary-3">
            <div class="row">
                <div class="col">
                    <div class="pagetitle">
                        <span>{{ t('STORIE DI SUCCESSO') }}</span>
                    </div>
                </div>
            </div>

            @if($edit_enabled)
                <div class="row mb-2">
                    <div class="col">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#story-new">Crea Nuovo Riferimento</button>
                        @include('story.modal', ['story' => null])
                    </div>
                </div>
            @endif

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach(App\Story::orderBy('created_at', 'desc')->get() as $index => $story)
                    <div class="col">
                        <button data-bs-toggle="modal" data-bs-target="#story-{{ $story->id }}" class="button">
                            <div class="story-cell" style="background-image: url('{{ $story->cover_url }}')">
                                <span class="index">{{ $index + 1 }}.</span>
                                <span class="title">{{ $story->title }}<br><br></span>
                            </div>
                        </button>
                    </div>
                @endforeach
            </div>

            @foreach(App\Story::orderBy('created_at', 'desc')->get() as $story)
                @if($edit_enabled)
                    @include('story.modal', ['story' => $story])
                @else
                    <x-larastrap::modal classes="primary-2" :id="sprintf('story-%s', $story->id)">
                        <div class="row">
                            <div class="col">
                                {!! nl2br($story->contents) !!}
                            </div>
                        </div>
                    </x-larastrap::modal>
                @endif
            @endforeach
        </div>
    @endif
@endsection
