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
        </div>
    </div>
@endsection
