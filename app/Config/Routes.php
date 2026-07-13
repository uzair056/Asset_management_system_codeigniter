<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/register', 'UserController::show_register');
$routes->get('/login', 'UserController::show_login');
$routes->post('/store', 'UserController::register');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/admin_dashboard', 'AdminController::index');
$routes->post('/admin/employees/save', 'AdminController::saveEmployee');
$routes->get('/admin/employees/delete/(:num)', 'AdminController::deleteEmployee/$1');
$routes->post('/admin/assets/save', 'AdminController::saveAsset');
$routes->get('/admin/assets/delete/(:num)', 'AdminController::deleteAsset/$1');
$routes->post('/admin/assignments/assign', 'AdminController::assignAsset');
$routes->get('/admin/assignments/return/(:num)', 'AdminController::returnAsset/$1');
$routes->get('/admin/reports/assignments', 'AdminController::exportAssignmentsReport');

$routes->get('/user_dashboard', 'UserController::index');
