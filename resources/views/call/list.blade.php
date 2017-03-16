@extends('layouts.app')

@section('title', 'Manca')

@section('content')
    <div class="manca">
        @if($edit_enabled)
        	<div class="row">
        		<div class="col-md-12">
        			<button class="btn btn-default" data-toggle="modal" data-target="#new-call">Crea Nuovo Appello</button>
        		</div>
        	</div>

        	@include('call.modal', ['call' => null])
        @endif

    	<div class="row">
    		<div class="col-md-2">
                <h2>manca!</h2>

                <p>
                    Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla.
                </p>

                <ul class="categories-select primary-2">
                    @foreach(App\Category::where('parent_id', 0)->orderBy('name', 'asc')->get() as $cat)
                    	<li class="border-top">
                            <span><a href="{{ url('manca/?filter=' . $cat->id) }}">{{ $cat->name }}</a></span>

                            <ul>
                            	@foreach($cat->children as $sub)
                    				<li>
                                        <span><a href="{{ url('manca/?filter=' . $sub->id) }}">{{ $sub->name }}</a></span>
                                    </li>
                            	@endforeach
                            </ul>

                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-9 col-md-offset-1 primary-2">
                @if($calls->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono appelli.
                        </p>
                    </div>
                @else
    				@foreach($calls as $call)
                        <div class="col-md-4 right-p">
                            <div class="common-card">
                                <div class="card-main image-frame" style="background-image: url('https://placeholdit.imgix.net/~text?txtsize=33&txt=boh...&w=150&h=250')">
                                    &nbsp;
                                </div>
                                <div class="card-footer vert-align">
                                    <p>
                                        <a href="{{ url('celo') }}">{{ $call->title }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
    				@endforeach

        			{{ $calls->links() }}
                @endif
    		</div>
    	</div>
    </div>
@endsection
