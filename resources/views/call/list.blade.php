@extends('layouts.app')

@section('title', 'Manca')

@section('content')
    <input type="hidden" name="trigger-show-details" data-endpoint="manca" data-item-id="{{ $current_show }}">

    <div class="manca primary-2">
    	<div class="row">
    		<div class="col-md-3 col-lg-2">
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
                    Ce l'hai?<br/>
                    Rispondi alle nostre call, ti contatteremo appena possibile!
                </p>

                @include('category.filter', ['filter' => $filter, 'direct_response' => true, 'endpoint' => 'manca'])
            </div>

            <div class="col-md-8 col-md-offset-1 col-lg-9 col-lg-offset-1 primary-2">
                @if($calls->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono appelli.
                        </p>
                    </div>
                @else
    				@foreach($calls as $call)
                        <?php $image = $call->image ?>
                        @if($image)
                            <div class="col-md-6 col-lg-4 right-p">
                                <div class="common-card {{ $call->category && $call->category->direct_response ? 'primary-1' : '' }}">
                                    <div class="card-main image-frame" style="background-image: url('{{ $image }}')">
                                        &nbsp;
                                    </div>
                                    @if($call->status == 'closed')
                                        <div class="card-main-filter">
                                        </div>
                                        <div class="card-main-overlay">
                                            <span>
                                                <p>Trovato!</p>
                                            </span>
                                        </div>
                                    @endif
                                    <div class="card-footer vert-align">
                                        <p>
                                            <a class="show-details" data-endpoint="manca" data-item-id="{{ $call->id }}">{{ $call->title }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
    				@endforeach

                    <p class="clearfix">&nbsp;</p>

                    <div class="text-center">
                        {{ $calls->links() }}
                    </div>
                @endif
    		</div>
    	</div>
    </div>
@endsection
