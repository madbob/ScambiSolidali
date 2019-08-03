<?php

$categories = App\Category::where('parent_id', 0)->orderBy('name', 'asc');
if ($direct_response == false)
    $categories->where('direct_response', false);
$categories = $categories->get();

?>

<ul class="categories-select visible-md visible-lg">
    @if($filter != null)
        <li class="border-top">
            <span><a href="{{ url($endpoint) }}">Elimina Filtro</a></span>
        </li>
    @endif

    @foreach($categories as $cat)
        <li class="border-top {{ $cat->id == $filter ? 'selected' : '' }}">
            <span><a href="{{ url($endpoint . '/?filter=' . $cat->id) }}">{{ $cat->name }}</a></span>

            <ul>
                @foreach($cat->children as $sub)
                    <li class="{{ $sub->id == $filter ? 'selected' : '' }}">
                        <span><a href="{{ url($endpoint . '/?filter=' . $sub->id) }}">{{ $sub->name }}</a></span>
                    </li>
                @endforeach
            </ul>

        </li>
    @endforeach
</ul>
