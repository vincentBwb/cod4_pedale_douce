<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');

$routes->get('/signup', 'SignupController::index');
$routes->post('/signup', 'SignupController::form');

$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::form');

$routes->get('/bluecard', 'BluecardController::index');
$routes->post('/bluecard', 'BluecardController::form');

$routes->get('/coordinates', 'CoordinatesController::index');
$routes->post('/coordinates', 'CoordinatesController::form');

$routes->get('/profile', 'ProfileController::index');
$routes->post('/profile', 'ProfileController::form');

$routes->get('/bike', 'BikeController::index');
$routes->post('/bike', 'BikeController::form');

$routes->get('/borne', 'BorneController::index');
$routes->post('/borne', 'BorneController::form');

$routes->get('/confirmation', 'ConfirmationController::index');
$routes->post('confirmation', 'ConfirmationController::form');

$routes->get('/cancelation', 'CancelationController::index');
$routes->post('cancelation', 'CancelationController::form');

$routes->get('/logout', 'LogoutController::index');

$routes->get('/test', 'TestController::test');

//* --------------------------------------------------------------------
//* Admin routes

$routes->get('/admin', 'AdminController::index');

$routes->get('/admin/users/create', 'AdminController::usersCreate');
$routes->get('/admin/stations/create', 'AdminController::stationsCreate');
$routes->get('/admin/bikes/create', 'AdminController::bikesCreate');
$routes->get('/admin/bornes/create', 'AdminController::bornesCreate');
$routes->get('/admin/blue_cards/create', 'AdminController::bluecardsCreate');

$routes->get('/admin/users/list', 'AdminController::usersList');
$routes->get('/admin/stations/list', 'AdminController::stationsList');
$routes->get('/admin/bikes/list', 'AdminController::bikesList');
$routes->get('/admin/bornes/list', 'AdminController::bornesList');
$routes->get('/admin/blue_cards/list', 'AdminController::bluecardsList');

$routes->get('/admin/users/edit/(:num)', 'AdminController::usersEdit/$1');
$routes->get('/admin/stations/edit/(:num)', 'AdminController::stationsEdit/$1');
$routes->get('/admin/bikes/edit/(:num)', 'AdminController::bikesEdit/$1');
$routes->get('/admin/bornes/edit/(:num)', 'AdminController::bornesEdit/$1');
$routes->get('/admin/blue_cards/edit/(:num)', 'AdminController::bluecardsEdit/$1');

$routes->post('/admin/users/save', 'AdminController::usersSave');
$routes->post('/admin/stations/save', 'AdminController::stationsSave');
$routes->post('/admin/bikes/save', 'AdminController::bikesSave');
$routes->post('/admin/bornes/save', 'AdminController::bornesSave');
$routes->post('/admin/blue_cards/save', 'AdminController::bluecardsSave');

$routes->get('/admin/users/del/(:num)', 'AdminController::usersDel/$1');
$routes->get('/admin/stations/del/(:num)', 'AdminController::stationsDel/$1');
$routes->get('/admin/bikes/del/(:num)', 'AdminController::bikesDel/$1');
$routes->get('/admin/bornes/del/(:num)', 'AdminController::bornesDel/$1');
$routes->get('/admin/blue_cards/del/(:num)', 'AdminController::bluecardsDel/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
