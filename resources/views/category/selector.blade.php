<?php $categories = App\Category::where('parent_id', 0)->orderBy('name', 'asc')->get() ?>

@foreach($categories as $cat)
	@if ($orientation == 'horizontal')
		<div class="col-md-3 black">
	@else
		<div class="row black">
	@endif

	<h5>{{ $cat->name }}</h5>

	@if($cat->children->count() == 0)
		<div class="radio radio-custom">
			<input id="category_{{ $cat->id }}" type="radio" name="category_id" value="{{ $cat->id }}" {{ $selected == $cat->id ? 'checked' : '' }} required>
			<label for="category_{{ $cat->id }}">{{ $cat->name }}</label>
		</div>
	@else
		@foreach($cat->children as $sub)
			<div class="radio radio-custom">
				<input id="category_{{ $sub->id }}" type="radio" name="category_id" value="{{ $sub->id }}" {{ $selected == $sub->id ? 'checked' : '' }} required>
				<label for="category_{{ $sub->id }}">{{ $sub->name }}</label>
			</div>
		@endforeach
	@endif

	</div>
@endforeach

@if(isset($and_service) && $and_service)
    @if ($orientation == 'horizontal')
        <div class="col-md-3 black">
    @else
        <div class="row black">
    @endif

        <h5>Servizi</h5>

		<div class="radio radio-custom">
			<input id="category_service" type="radio" name="category_id" value="service" {{ $selected == 'service' ? 'checked' : '' }} required>
			<label for="category_service">Servizi</label>
		</div>
    </div>
@endif

<p class="clearfix"></p>
