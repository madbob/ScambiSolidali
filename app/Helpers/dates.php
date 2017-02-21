<?php

use Date;

function decodeDate($date)
{
    if ($date == '') {
        return '';
    }

    $months = [
        'gennaio' => 'january',
        'febbraio' => 'february',
        'marzo' => 'march',
        'aprile' => 'april',
        'maggio' => 'may',
        'giugno' => 'june',
        'luglio' => 'july',
        'agosto' => 'august',
        'settembre' => 'september',
        'ottobre' => 'october',
        'novembre' => 'november',
        'dicembre' => 'december',
    ];

    list($weekday, $day, $month, $year) = explode(' ', $date);
    $en_date = sprintf('%s %s %s', $day, $months[strtolower($month)], $year);

    return date('Y-m-d', strtotime($en_date));
}

function printableDate($date)
{
    return ucwords(Date::parse($date)->format('l d F Y'));
}
