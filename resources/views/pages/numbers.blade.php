@extends('layouts.app')

@section('title', 'Numeri')

@section('content')
    <div class="numbers primary-2">
        <div class="row">
            <div class="col-md-12">
                <div class="pagetitle">
                    <span>STORIE A LIETO FINE</span>
                </div>
            </div>

            <?php

            $donated = App\Donation::whereIn('status', ['pending', 'assigned'])->count();
            $donated_width = 70;
            if ($donated != 0) {
                $assigned = App\Donation::where('status', 'assigned')->count();
                $assigned_width = (70 * $assigned) / $donated;
            }

            ?>

            @if($donated != 0)
                <div class="col-md-12">
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

            <?php

                $max_absolute = array_sum($categories);
                $max_relative = max($categories);

            ?>

            @if($max_absolute != 0)
                <div class="col-md-12">
                    @foreach($categories as $name => $count)
                        <div class="col-md-3">
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
    </div>

    @if(App\Story::count() > 0 || $edit_enabled)
        <br>

        <div class="stories primary-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="pagetitle">
                        <span>STORIE DI SUCCESSO</span>
                    </div>
                </div>
            </div>

            @if($edit_enabled)
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-default" data-toggle="modal" data-target="#story-new">Crea Nuovo Riferimento</button>
                        @include('story.modal', ['story' => null])
                    </div>
                </div>
            @endif

            <div class="row">
                @foreach(App\Story::orderBy('created_at', 'desc')->get() as $index => $story)
                    <div class="col-md-4">
                        <button data-toggle="modal" data-target="#story-{{ $story->id }}" class="button">
                            <div class="story-cell" style="background-image: url('{{ $story->cover_url }}')">
                                <span class="index">{{ $index + 1 }}.</span>
                                <span class="title">{{ $story->title }}<br><br></span>
                            </div>
                        </button>
                    </div>

                    @if($edit_enabled)
                        @include('story.modal', ['story' => $story])
                    @else
                        <div class="modal fade primary-3" id="story-{{ $story->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! nl2br($story->contents) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endsection
