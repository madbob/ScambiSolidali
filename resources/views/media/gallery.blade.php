@extends($layout)

@section('title', 'Galleria')

@section('content')
    <div class="gallery">
        <div class="row primary-6">
            <div class="pagetitle">
                <span>GALLERIA</span>
            </div>
        </div>

        @if($edit_enabled)
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-default" data-toggle="modal" data-target="#media-new">Crea Nuovo Riferimento</button>
                    @include('media.modal', ['media' => null, 'context' => $context])
                </div>
            </div>
        @endif

        <div class="row primary-6">
            @foreach($media as $m)
                <div class="col-md-4 px-4">
                    <img class="img-responsive" src="{{ $m->link }}">
                    <hr>
                    <p>{{ $m->text }}</p>

                    @if($edit_enabled)
                        <button class="btn btn-default" data-toggle="modal" data-target="#media-{{ $m->id }}">Modifica</button>
                    @endif

                    <hr>
                </div>
            @endforeach
        </div>
    </div>

    @if($edit_enabled)
        @foreach($media as $m)
            @include('media.modal', ['media' => $m, 'context' => $context])
        @endforeach
    @endif
@endsection
