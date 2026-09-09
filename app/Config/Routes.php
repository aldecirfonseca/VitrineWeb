<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get("faleconosco", "Home::faleconosco");
$routes->get("sobrenos", "Home::sobrenos");

$routes->group("categoria", static function($routes) {
    $routes->get("/", "Categoria::index");
    $routes->get("form/(:alpha)/(:num)", "Categoria::form/$1/$2");
    $routes->post("insert", "Categoria::insert");
    $routes->put("update", "Categoria::update");
    $routes->delete("delete", "Categoria::delete");
    $routes->match(["post", "put"],"store", "Categoria::store");
});