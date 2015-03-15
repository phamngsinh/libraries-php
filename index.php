<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/29/14
 * Time: 9:48 AM
 */
date_default_timezone_set('UTC');
$date = new DateTime('2000-01-01');
$date->add(new DateInterval('PT10H30S'));
echo ( json_encode($date) );

$date = new DateTime('2000-01-01');
$date->add(new DateInterval('PT4H3M2S'));
