<?php

include_once "router.php";
include_once "test.php";

$r = new \diversen\router();

// Example 'test' route
$route =  array (
    'match' => '#/test/[0-9]+#',
    'class' => '\router\test',
    'method' => 'testAction');

$r->setRoute($route);

// Example 'home' route
$route =  array (
    'match' => '#^/$#',
    'class' => '\router\test',
    'method' => 'homeAction');


$r->setRoute($route);
$r->match();