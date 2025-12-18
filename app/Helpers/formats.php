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

function inBytes($val)
{
    if (empty($val)) {
        $val = 0;
    }

    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    $val = floatval($val);

    switch($last) {
        case 'g':
            $val *= (1024 * 1024 * 1024);
            break;
        case 'm':
            $val *= (1024 * 1024);
            break;
        case 'k':
            $val *= 1024;
            break;
    }

    return $val;
}

function genCaptcha()
{
    $captcha_1 = rand(1, 10);
    $captcha_2 = rand(1, 10);
    $captcha_final = $captcha_1 + $captcha_2;
    \Session::put('captcha_response', $captcha_final);
    return sprintf('%s + %s', $captcha_1, $captcha_2);
}
