@extends('layouts.app')

@section('title', 'Celo')

@section('content')
    <div class="celo primary-1">
    	<div class="row">
    		<div class="col-md-2">
                <a href="{{ url('celo/nuovo') }}" class="dense-button">
                    <span>Celo!</span>
                </a>

                <br/>

                <p>
                    Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla.
                </p>

                <ul class="categories-select">
                    @foreach(App\Category::where('parent_id', 0)->orderBy('name', 'asc')->get() as $cat)
                    	<li class="border-top">
                            <span><a href="{{ url('celo/?filter=' . $cat->id) }}">{{ $cat->name }}</a></span>

                            <ul>
                            	@foreach($cat->children as $sub)
                    				<li>
                                        <span><a href="{{ url('celo/?filter=' . $sub->id) }}">{{ $sub->name }}</a></span>
                                    </li>
                            	@endforeach
                            </ul>

                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-9 col-md-offset-1">
                @if($donations->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono oggetti.
                        </p>
                    </div>
                @else
    				@foreach($donations as $donation)
                        <div class="col-md-4 right-p">
                            <div class="common-card">
                                <div class="card-main image-frame" style="background-image: url('{{ $donation->imageUrl(1) }}')">
                                    &nbsp;
                                </div>
                                @if($donation->status == 'assigned')
                                    <div class="card-main-filter">
                                    </div>
                                    <div class="card-main-overlay">
                                        <span>Consegnato!</span>
                                    </div>
                                @endif
                                <div class="card-footer vert-align">
                                    <p>
                                        @if($edit_enabled)
                                            <a class="show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}">{{ $donation->title }}</a>
                                        @else
                                            <a>{{ $donation->title }}</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
    				@endforeach

        			{{ $donations->links() }}
                @endif
    		</div>
    	</div>
    </div>
@endsection
