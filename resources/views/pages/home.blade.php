@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales, mauris vitae tristique laoreet, massa libero ultrices sem, eget ultricies nibh augue a nibh. Praesent eu vulputate enim. Donec volutpat eget nisl quis posuere. Praesent dapibus quam et arcu mattis hendrerit. Aliquam mattis quis nulla non viverra. Quisque id felis eu orci efficitur vehicula tincidunt ut elit. Donec magna mi, aliquet vitae malesuada sit amet, tempor nec quam. Morbi ultrices feugiat tellus at mattis. Nunc et viverra neque. Curabitur efficitur condimentum euismod. Vestibulum vel nunc ipsum.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <a href="{{ url('donazione/create') }}" class="btn btn-default btn-lg">Dona adesso</a>
        </div>
    </div>

    <?php $calls = App\Call::where('status', 'open')->get() ?>
    @if($calls->isEmpty() == false)
        <div class="row">
            <ul class="list-group">
                @foreach($calls as $call)
                    <li class="list-group-item">
                        <span class="badge">{{ printableDate($call->created_at) }}</span>
                        <h4 class="list-group-item-heading">{{ $call->title }}</h4>
                        <p>{!! nl2br($call->body) !!}</p>
                        <a class="btn btn-default pull-right" href="{{ url('donazione/create?call=' . $call->id) }}">Rispondi all'appello!</a>
                        <div class="clearfix"></div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
