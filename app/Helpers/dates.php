<?php

function printableDate($date)
{
    if ($date) {
        $fmt = new \IntlDateFormatter('it_IT', NULL, NULL);
        $fmt->setPattern('dd MMMM yyyy');
        return ucwords($fmt->format(new DateTime($date)));
    }
    else {
        return '-';
    }
}

function canonicalDate($date)
{
    return (new DateTime($date))->format('Y-m-d');
}
