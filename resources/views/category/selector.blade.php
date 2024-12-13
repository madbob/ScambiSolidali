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
    <x-larastrap::field label="Categoria">
    	@foreach($categories as $cat)
			<div class="black">
        		<h5>{{ $cat->name }}</h5>

        		@if($cat->children->count() == 0)
                    <x-larastrap::radiolist-model name="category_id" squeeze :options="[$cat]" :value="$selected" />
        		@else
                    <x-larastrap::radiolist-model name="category_id" squeeze :options="$cat->children" :value="$selected" />
        		@endif
    		</div>
    	@endforeach
    </x-larastrap::field>
@endif
