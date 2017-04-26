<?php

include_once "router.php";
include_once "test.php";

// You will not need the above includes
// if you use have added class to vendor
// using composer
$r = new \diversen\router();

// Example 'test' route
$route =  array (
    'match' => '#/test/[0-9]+#',
    'class' => '\diversen\test',
    'method' => 'testAction');

$r->setRoute($route);

// Example 'home' route
$route =  array (
    'match' => '#^/$#',
    'class' => '\diversen\test',
    'method' => 'homeAction');


$r->setRoute($route);
$r->match();
