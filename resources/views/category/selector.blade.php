<?php

$query = App\Category::where('parent_id', 0)->orderBy('name', 'asc');
if ($type != 'all') {
	$query->where('type', $type);
}
if ($direct_response == false) {
	$query->where('direct_response', false);
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

    <x-larastrap::field label="Categoria">
    	@foreach($categories as $cat)
    		@if ($orientation == 'horizontal')
    			<div class="col-md-{{ $col_size }} black">
    		@else
    			<div class="row black">
    		@endif

    		<h5>{{ $cat->name }}</h5>

    		@if($cat->children->count() == 0)
                <x-larastrap::radiolist-model name="category_id" squeeze :options="[$cat]" />
    		@else
                <x-larastrap::radiolist-model name="category_id" squeeze :options="$cat->children" />
    		@endif

    		</div>
    	@endforeach
    </x-larastrap::field>

	<p class="clearfix"></p>
@endif
