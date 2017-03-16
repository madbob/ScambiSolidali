@extends('layouts.app')

@section('title', 'Celo')

@section('content')
    <div class="manca">
    	<div class="row">
    		<div class="col-md-12">
    			<a href="{{ url('celo/nuovo') }}" class="btn btn-default">Celo! (questo tasto è da mettere da qualche parte)</a>
    		</div>
    	</div>

    	<div class="row">
    		<div class="col-md-2">
                <h2>celo!</h2>

                <p>
                    Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla.
                </p>

                <ul class="categories-select primary-1">
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
                                <div class="card-footer vert-align">
                                    <p>
                                        <a href="{{ url('celo') }}">{{ $donation->title }}</a>
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
