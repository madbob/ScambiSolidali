<?php

$items = App\Donation::areas();

$groups = [
    [],
    [],
    [],
];

$group_iter = 0;
$iter = 0;
$upgrade = ceil(count($items) / 2);

foreach($items as $it_key => $it_val) {
    $groups[$group_iter][$it_key] = $it_val;
    $iter++;
    if ($iter == $upgrade) {
        $group_iter++;
        $iter = 0;
    }
}

if (!isset($field_name)) {
    $field_name = 'receiver-area';
}

if (!isset($selected)) {
    $selected = null;
}

?>

@foreach($groups as $items)
    <div class="col-sm-6">
        @foreach($items as $it_key => $it_val)
            <?php $it_slug = Illuminate\Support\Str::slug($it_key) ?>
            <div class="radio radio-custom">
                <input id="area_{{ $it_slug }}" type="radio" name="{{ $field_name }}" value="{{ $it_key }}" required {{ $selected == $it_key ? 'checked' : '' }}>
                <label for="area_{{ $it_slug }}">{{ $it_val }}</label>
            </div>
        @endforeach
    </div>
@endforeach
