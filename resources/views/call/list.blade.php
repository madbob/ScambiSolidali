@extends('layouts.app')

@section('title', 'Manca')

@section('content')
    <div class="manca primary-2">
    	<div class="row">
    		<div class="col-md-2">
                @if($edit_enabled)
                    <button class="dense-button" data-toggle="modal" data-target="#new-call">
                        <span>Manca!</span>
                    </button>
                    @include('call.modal', ['call' => null])
                @else
                    <p class="dense-button">
                        <span>Manca!</span>
                    </p>
                @endif

                <br/>

                <p>
                    Guarda cosa ci manca!<br/>
                    Hai uno di questi oggetti? Vuoi donarcelo?<br/>
                    Rispondi alle nostre call, ti contatteremo appena possibile!
                </p>

                <ul class="categories-select">
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
                                @if($call->status == 'archived')
                                    <div class="card-main-filter">
                                    </div>
                                    <div class="card-main-overlay">
                                        <span>Trovato!</span>
                                    </div>
                                @endif
                                <div class="card-footer vert-align">
                                    <p>
                                        <a class="show-details" data-endpoint="manca" data-item-id="{{ $call->id }}">{{ $call->title }}</a>
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
