<?php

function currentInstance()
{
    $city = App\Config::getConf('instance_city');
    return flatString($city);
}
