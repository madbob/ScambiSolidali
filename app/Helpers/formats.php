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

function t($string)
{
    static $texts = null;

    if (is_null($texts)) {
        $config = App\Config::getConf('strings');
        $texts = json_decode($config);
        if (is_null($texts)) {
            $texts = [];
        }
    }

    foreach($texts as $text) {
        if ($text->original == $string) {
            return $text->custom;
        }
    }

    return $string;
}
