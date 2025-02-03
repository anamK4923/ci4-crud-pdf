<?php

use CodeIgniter\Router\RouteCollection;
use Config\Services;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();
$routes->get('/', 'BookController::index');
$routes->get('books', 'BookController::index');
$routes->get('books/create', 'BookController::create');
$routes->post('books/store', 'BookController::store');
$routes->get('books/edit/(:num)', 'BookController::edit/$1');
$routes->post('books/update/(:num)', 'BookController::update/$1');
$routes->get('books/delete/(:num)', 'BookController::delete/$1');
$routes->get('books/pdf', 'BookController::generatePdf');
