<?php

$areas = App\Donation::areas();

?>

<ul class="categories-select visible-md visible-lg">
    @if($areafilter != null)
        <li class="border-top">
            <span><a href="{{ url($endpoint) }}">Elimina Filtro</a></span>
        </li>
    @endif

    @foreach($areas as $area_key => $area_name)
        <li class="border-top {{ $area_key == $areafilter ? 'selected' : '' }}">
            <span><a href="{{ url($endpoint . '/?areafilter=' . $area_key) }}">{{ $area_name }}</a></span>
        </li>
    @endforeach
</ul>
