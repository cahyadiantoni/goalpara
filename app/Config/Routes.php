<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/home', 'HomeController::index');
$routes->get('/loket', 'LoketController::index');
$routes->post('/submitTransaksi', 'LoketController::submitTransaksi');
$routes->get('/minizoo', 'MiniZooController::index');
$routes->get('/booth', 'BoothController::index');
$routes->post('/cek_saldo', 'SaldoController::ceksaldo');
$routes->get('/saldo', 'SaldoController::index');
$routes->get('/summary', 'SummaryController::index');
$routes->get('/rekap', 'RekapController::index');
$routes->get('/gate', 'GateController::index');
$routes->get('/gatecek/(:num)', 'GateController::gatecek/$1');
$routes->post('/cekgate', 'GateController::cekgate');
