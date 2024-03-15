<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/home', 'HomeController::index');
$routes->get('/loket', 'LoketController::index');
