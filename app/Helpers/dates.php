<?php

function printableDate($date)
{
    $fmt = new \IntlDateFormatter('it_IT', NULL, NULL);
    $fmt->setPattern('EEEE dd MMMM yyyy');
    return ucwords($fmt->format(new DateTime($date)));
}

function canonicalDate($date)
{
    return (new DateTime($date))->format('Y-m-d');
}
