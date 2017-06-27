<?php

include_once "router.php";
include_once "test.php";

// You will not need the above includes
// if you use have added class to vendor
// using composer
$r = new \diversen\router();

// Example 'test' route. Match /test/2/123123 (or any int as last part of path)
$route =  array (
    'match' => '#^/test/int/[0-9]+$#', 
    'class' => 'diversen\test',
    'method' => 'testAction');

$r->setRoute($route);
// Example 'test' route. Match /test/anything
$route =  array (
    'match' => '#^/test/login/(.*?)+$#', 
    'class' => 'diversen\test',
    'method' => 'testAction');

$r->setRoute($route);

// Example 'home' route. Only match /
$route =  array (
    'match' => '#^/$#',
    'class' => '\diversen\test',
    'method' => 'homeAction');

$r->setRoute($route);
$r->match();
