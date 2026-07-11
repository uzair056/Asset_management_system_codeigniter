<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
 $routes->get('/admin_dashboard', 'AdminController::index');
$routes->get('/register', 'UserController::show_register');
$routes->get('/login', 'UserController::show_login');
$routes->post('/store', 'UserController::register');

$routes->post('/login', 'AuthController::login');