<?php $categories = App\Category::where('parent_id', 0)->orderBy('name', 'asc')->get() ?>

@foreach($categories as $cat)
	@if ($orientation == 'horizontal')
		<div class="col-md-3 black">
	@else
		<div class="row black">
	@endif

	<h5>{{ $cat->name }}</h5>

	@foreach($cat->children as $sub)
		<div class="radio">
			<label>
				<input type="radio" name="category_id" value="{{ $sub->id }}" {{ $selected == $sub->id ? 'checked' : '' }}>
				{{ $sub->name }}
			</label>
		</div>
	@endforeach

	</div>
@endforeach

@if(isset($and_service) && $and_service)
    @if ($orientation == 'horizontal')
        <div class="col-md-3 black">
    @else
        <div class="row black">
    @endif

        <h5>Servizi</h5>

        <div class="radio">
            <label>
                <input type="radio" name="category_id" value="service" {{ $selected == 'service' ? 'checked' : '' }}>
                Servizi
            </label>
        </div>
    </div>
@endif

<p class="clearfix"></p>
