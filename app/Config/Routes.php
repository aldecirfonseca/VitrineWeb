<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ---------------------------------------------------------------------
// Área pública
// ---------------------------------------------------------------------
$routes->get('/', 'Home::index');
$routes->get('produto/(:num)', 'Home::produto/$1');
$routes->get("faleconosco", "Home::faleconosco");
$routes->post("faleconosco", "Home::enviarContato");
$routes->get("sobrenos", "Home::sobrenos");

$routes->get("login", "Home::login");
$routes->get("criarNovaConta", "Home::criarNovaConta");
$routes->post("gravarNovaConta", "Home::gravarNovaConta");

$routes->group("Login", static function ($routes) {
    $routes->post("signIn", "Login::signIn");
    $routes->get("signOut", "Login::signOut");
});

// Carrinho: montar o carrinho não exige login; fechar o pedido exige
$routes->group("Carrinho", static function ($routes) {
    $routes->get("/", "Carrinho::index");
    $routes->post("adicionar", "Carrinho::adicionar");
    $routes->post("atualizar", "Carrinho::atualizar");
    $routes->post("remover", "Carrinho::remover");
    $routes->post("limpar", "Carrinho::limpar");
    $routes->get("checkout", "Carrinho::checkout", ["filter" => "auth"]);
    $routes->post("finalizar", "Carrinho::finalizar", ["filter" => "auth"]);
    $routes->get("confirmacao/(:num)", "Carrinho::confirmacao/$1", ["filter" => "auth"]);
});

// Pedidos do cliente logado
$routes->group("MeusPedidos", ["filter" => "auth"], static function ($routes) {
    $routes->get("/", "Pedido::meus");
    $routes->get("(:num)", "Pedido::meuDetalhe/$1");
});

// ---------------------------------------------------------------------
// Painel administrativo
// (na Aula 3 estes grupos passam a usar "auth:1", só para administradores)
// ---------------------------------------------------------------------
$routes->get("Sistema/home", "Sistema::home", ["filter" => "auth"]);

$routes->group("Categoria", ["filter" => "auth"], static function ($routes) {
    $routes->get("/", "Categoria::index");
    $routes->get("form/(:alpha)/(:num)", "Categoria::form/$1/$2");
    $routes->post("store", "Categoria::store");
    $routes->post("delete", "Categoria::delete");
});

$routes->group("Produto", ["filter" => "auth"], static function ($routes) {
    $routes->get("/", "Produto::index");
    $routes->get("form/(:alpha)/(:num)", "Produto::form/$1/$2");
    $routes->post("store", "Produto::store");
    $routes->post("delete", "Produto::delete");
});

$routes->group("Pedido", ["filter" => "auth"], static function ($routes) {
    $routes->get("/", "Pedido::index");
    $routes->get("form/view/(:num)", "Pedido::form/$1");
    $routes->post("status", "Pedido::status");
});
