<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('rsvp/(:any)', 'UserController::getInviteeData/$1');
$routes->get('/generate', 'UserController::inviteIDGenerator');

$routes->post('/confirm', 'UserController::confirmRSVP');

