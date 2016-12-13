@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales, mauris vitae tristique laoreet, massa libero ultrices sem, eget ultricies nibh augue a nibh. Praesent eu vulputate enim. Donec volutpat eget nisl quis posuere. Praesent dapibus quam et arcu mattis hendrerit. Aliquam mattis quis nulla non viverra. Quisque id felis eu orci efficitur vehicula tincidunt ut elit. Donec magna mi, aliquet vitae malesuada sit amet, tempor nec quam. Morbi ultrices feugiat tellus at mattis. Nunc et viverra neque. Curabitur efficitur condimentum euismod. Vestibulum vel nunc ipsum.
            </p>
        </div>
        <div class="col-md-6">
            <a href="{{ url('donazione/create') }}" class="btn btn-default btn-lg">Dona adesso</a>
        </div>
    </div>
@endsection
