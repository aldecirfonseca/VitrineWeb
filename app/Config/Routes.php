<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
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

$routes->get("Sistema/home", "Sistema::home", ["filter" => "auth"]);

$routes->group("Categoria", ["filter" => "auth"], static function($routes) {
    $routes->get("/", "Categoria::index");
    $routes->get("form/(:alpha)/(:num)", "Categoria::form/$1/$2");
    $routes->post("insert", "Categoria::insert");
    $routes->put("update", "Categoria::update");
    $routes->post("delete", "Categoria::delete");
    $routes->match(["post", "put"],"store", "Categoria::store");
});