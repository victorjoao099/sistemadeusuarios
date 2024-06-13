<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('cadastro', 'CadastroController::index', ['as' => 'cadastro.index']);

$routes->post('cadastro', 'CadastroController::cadastrar', ['as' => 'cadastro.cadastrar']);

$routes->get('login', 'LoginController::index', ['as' => 'login.index']);

$routes->post('login', 'LoginController::entrar', ['as' => 'login.entrar']);

$routes->get('paginicial', 'InicialController::index', ['as' => 'inicial.index']);

$routes->get('logout', 'InicialController::logout', ['as' => 'inicial.logout']);
