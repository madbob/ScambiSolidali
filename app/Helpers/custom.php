<?php

function currentInstance()
{
    static $city = null;

    if (is_null($city)) {
        $city = App\Config::getConf('instance_city');
        $city = flatString($city);
    }

    return $city;
}
