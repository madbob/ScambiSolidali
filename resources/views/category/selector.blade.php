<?php

$query = App\Category::where('parent_id', 0)->orderBy('name', 'asc');
if ($type != 'all') {
	$query->where('type', $type);
}
$categories = $query->get();

?>

@if($categories->count() == 1 && $categories->first()->children->count() <= 1)
	<input type="hidden" name="category_id" value="{{ $categories->first()->id }}">
@else
	<?php

	if ($orientation == 'horizontal') {
		if ($categories->count() % 3 == 0) {
			$col_size = 4;
		}
		else if ($categories->count() % 2 == 0) {
			$col_size = 6;
		}
		else if ($categories->count() == 1) {
			$col_size = 12;
		}
		else {
			$col_size = 6;
		}
	}

	?>

	<div class="form-group">
        <label for="category_id" class="col-sm-2 col-md-3 control-label">Categoria</label>
        <div class="col-sm-10 col-md-9">
			@foreach($categories as $cat)
				@if ($orientation == 'horizontal')
					<div class="col-md-{{ $col_size }} black">
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
		</div>
	</div>

	<p class="clearfix"></p>
@endif
