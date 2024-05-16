<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


//auth
$routes->get('/logout', "Auth::logout");
$routes->post('/login', 'Auth::login');

//admin
$routes->get('/car', 'Admin::car');
$routes->get('/car/return', 'Admin::carReturn');
$routes->get('/order', 'Admin::order');
$routes->post('/order', 'Admin::orderAction');
$routes->get('/activity', 'Admin::activity');

//approver
$routes->get('/approveok', 'Approver::approveOk');
$routes->get('/rejected', 'Approver::rejected');
$routes->get('/inbox', 'Approver::inbox');
