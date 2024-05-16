<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/car', 'Home::car');
$routes->get('/order', 'Home::order');
$routes->get('/activity', 'Home::activity');
$routes->get('/inbox', 'Home::inbox');


$routes->post('/order', 'Home::orderAction');

$routes->get('/logout', "Auth::logout");
$routes->post('/login', 'Auth::login');


$routes->get('/approveok', 'Home::approveOk');
$routes->get('/rejected', 'Home::rejected');
