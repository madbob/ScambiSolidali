<?php

$items = App\Donation::areas();

if (!isset($field_name)) {
    $field_name = 'receiver-area';
}

if (!isset($selected)) {
    $selected = null;
}

if (!isset($label)) {
    $label = 'Residenza';
}

?>

<x-larastrap::radiolist :name="$field_name" :label="$label" :options="$items" :value="$selected" />
