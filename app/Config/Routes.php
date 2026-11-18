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

// Senha: recuperar (sem login) e trocar (logado)
$routes->get("esqueciSenha", "Senha::esqueci");
$routes->post("esqueciSenha", "Senha::enviarLink");
$routes->get("redefinirSenha/(:alphanum)", "Senha::redefinir/$1");
$routes->post("redefinirSenha", "Senha::gravar");
$routes->get("trocarSenha", "Senha::trocar", ["filter" => "auth"]);
$routes->post("trocarSenha", "Senha::gravarTroca", ["filter" => "auth"]);

// ---------------------------------------------------------------------
// Painel administrativo: "auth:1" = logado E com nível 1 (administrador).
// Cliente logado que digitar estas URLs volta para a loja com aviso.
// ---------------------------------------------------------------------
$routes->get("Sistema/home", "Sistema::home", ["filter" => "auth:1"]);

$routes->group("Usuario", ["filter" => "auth:1"], static function ($routes) {
    $routes->get("/", "Usuario::index");
    $routes->get("form/(:alpha)/(:num)", "Usuario::form/$1/$2");
    $routes->post("store", "Usuario::store");
});

$routes->group("Categoria", ["filter" => "auth:1"], static function ($routes) {
    $routes->get("/", "Categoria::index");
    $routes->get("form/(:alpha)/(:num)", "Categoria::form/$1/$2");
    $routes->post("store", "Categoria::store");
    $routes->post("delete", "Categoria::delete");
});

$routes->group("Produto", ["filter" => "auth:1"], static function ($routes) {
    $routes->get("/", "Produto::index");
    $routes->get("form/(:alpha)/(:num)", "Produto::form/$1/$2");
    $routes->post("store", "Produto::store");
    $routes->post("delete", "Produto::delete");
});

$routes->group("Pedido", ["filter" => "auth:1"], static function ($routes) {
    $routes->get("/", "Pedido::index");
    $routes->get("form/view/(:num)", "Pedido::form/$1");
    $routes->post("status", "Pedido::status");
});
