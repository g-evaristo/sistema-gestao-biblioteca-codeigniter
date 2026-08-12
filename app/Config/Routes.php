<?php
//Rotas Públicas
// Rotas Login
$routes->get('/', 'LoginController::index');
$routes->get('login', 'LoginController::index');
$routes->post('login/autenticar', 'LoginController::autenticar');
$routes->get('logout', 'LoginController::logout');

//Rotas Protegidas
$routes->group('', ['filter' => 'auth'], function($routes){
    // Rota Inicio
    $routes->get('inicio', 'InicioController::index');

    // Rotas Produtos
    $routes->match(['get', 'post'], 'produtos',  'ProdutosController::index');
    $routes->get('produtos/novo',                'ProdutosController::novo');
    $routes->post('produtos/inserir',            'ProdutosController::inserir');
    $routes->get('produtos/editar/(:num)',       'ProdutosController::editar/$1');
    $routes->post('produtos/atualizar/(:num)',   'ProdutosController::atualizar/$1');
    $routes->get('produtos/excluir/(:num)',      'ProdutosController::excluir/$1');

    // Rotas Estoques
    $routes->get('estoque',                     'EstoqueController::index');
    $routes->post('estoque/atualizar',         'EstoqueController::atualizar');
});