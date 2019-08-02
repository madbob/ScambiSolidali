<?php

function normalizeUrl($input)
{
    if (empty($input))
        return $input;

    $normalized = '';

    $url = parse_url($input);
    if (isset($url['scheme']) == false) {
        $normalized = 'http://';
    }

    return $normalized . $input;
}

function flatString($string)
{
    $string = mb_strtolower($string);
    $string = str_replace(' ', '', $string);
    return $string;
}
