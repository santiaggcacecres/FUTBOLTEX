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
    $routes->get('ejercicios', 'Exercises::exercices');
});
$routes->group('ejercicios', ['filter' => 'auth'], static function ($routes) {
    $routes->get('', 'Exercises::index');                // R: Ver listado
    $routes->get('nuevo', 'Exercises::nuevo');           // C: Formulario vacío
    $routes->post('guardar', 'Exercises::guardar');       // C: Guarda en la BD
    $routes->get('editar/(:num)', 'Exercises::editar/$1'); // U: Formulario con datos
    $routes->post('actualizar/(:num)', 'Exercises::actualizar/$1'); // U: Guarda cambios
    $routes->post('eliminar/(:num)', 'Exercises::eliminar/$1');   // D: Borra de la BD
});
