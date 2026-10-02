<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/iniciarSesion', 'Auth::iniciarSesion');

$routes->get('/register', 'Auth::register');
$routes->post('/guardarRegistro', 'Auth::guardarRegistro');

$routes->get('/logout', 'Auth::logout');
$routes->get('/home', 'Home::index');

$routes->group('ejercicios', ['filter' => 'auth'], static function ($routes) {
    $routes->get('', 'Ejercicios::index');
    $routes->get('nuevo', 'Ejercicios::nuevo');
    $routes->post('guardar', 'Ejercicios::guardar');
    $routes->get('editar/(:num)', 'Ejercicios::editar/$1');
    $routes->post('actualizar/(:num)', 'Ejercicios::actualizar/$1');
    $routes->post('eliminar/(:num)', 'Ejercicios::eliminar/$1');
});
