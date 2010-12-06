<?php

    require_once 'secrets.php';

    $cb = $_GET['cb'];
    $service = $_GET['service'];
    $value = $_GET['value'];

    $services = array(
        'dopplr',
        'foodspotting',
        'foursquare',
        'lastfm',
        'openplaques',
    );

    if(!$cb || !$service || !$value || !in_array($service, $services)) {
        exit;
    }

    header('Content-Type: application/x-javascript');

    require_once("parsers/$service.php");

    // array('latitude' => '23.5', longitude => '-150.3);
    $json_geodata = json_encode(get_geodata($value));
    
    echo "$cb($json_geodata);";

    function escape_string($string) {
        $searches = array('<', '>');
        $replacements = array('&lt;', '&gt;');
        return str_replace($searches, $replacements, $string);
    }
