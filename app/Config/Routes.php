<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('id/(:any)', 'UserController::confirmRSVP/$1');
$routes->get('/(:any)', 'UserController::getInviteeData/$1');
