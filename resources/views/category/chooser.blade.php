<?php $categories = App\Category::where('parent_id', 0)->orderBy('name', 'asc')->get() ?>

@foreach($categories as $cat)
	@if ($orientation == 'horizontal')
		<div class="col-md-3">
	@else
		<div class="row">
	@endif

	<h5>{{ $cat->name }}</h5>

	@foreach($cat->children as $sub)
		<div class="checkbox">
			<label>
				<input type="checkbox" name="category_id" value="{{ $sub->id }}" checked>
				{{ $sub->name }}
			</label>
		</div>
	@endforeach

	</div>
@endforeach
