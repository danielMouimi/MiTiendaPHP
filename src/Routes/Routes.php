<?php

namespace Routes;
use Controllers\CarritoController;
use Controllers\AuthController;
use Controllers\CategoriaController;
use Controllers\ErrorController;
use Controllers\ProductoController;
use Controllers\DashboardController;
use Lib\Router;
use Lib\Pages;


class Routes {
    private Pages $pages;
    public static function index() {

        Router::add('GET','/', function() {
            (new DashboardController())->index();
        });


        Router::add('GET', '/register', function () {
            (new AuthController())->register();
        });

        Router::add('POST', '/register', function () {
            (new AuthController())->register();
        });

        Router::add('GET', '/login', function () {
            (new AuthController())->login();
        });

        Router::add('POST', '/login', function () {
            (new AuthController())->login();
        });

        Router::add('GET', '/cerrar', function () {
            (new AuthController())->cerrarsesion();
        });

        Router::add('POST', '/cerrar', function () {
            (new AuthController())->cerrarsesion();
        });

        Router::add('GET', '/newCategory', function () {
            (new CategoriaController())->addCategoria();
        });

        Router::add('POST', '/newCategory', function () {
            (new CategoriaController())->addCategoria();
        });


        Router::add('GET', '/newProducto', function () {
            (new ProductoController())->addProducto();
        });

        Router::add('POST', '/newProducto', function () {
            (new ProductoController())->addProducto();
        });

        Router::add('GET', '/editProducto/:id', function ($id) {
            (new ProductoController())->editProducto($id);
        });

        Router::add('POST', '/editProducto/:id', function ($id) {
            (new ProductoController())->editProducto($id);
        });


        Router::add('GET', '/deleteProducto/:id', function ($id) {
            (new ProductoController())->deleteProducto($id);
        });

        Router::add('POST', '/deleteProducto/:id', function ($id) {
            (new ProductoController())->deleteProducto($id);
        });




        Router::add('GET', '/category/:id', function ($id) {
            (new ProductoController())->getProductosbyCat($id);
        });

        Router::add('GET', '/gestionarCategorias', function () {
            $categorias = (new CategoriaController())->getCategorias();
            $pages = new Pages();
            $pages->render('categories/gestionCategorias',['categorias' => $categorias]);
        });


        Router::add('GET', '/editCategoria/:id', function ($id) {
            (new CategoriaController())->editCategoria($id);
        });

        Router::add('POST', '/editCategoria/:id', function ($id) {
            (new CategoriaController())->editCategoria($id);
        });

        Router::add('GET', '/deleteCategoria/:id', function ($id) {
            (new CategoriaController())->deleteCategoria($id);
        });

        Router::add('POST', '/deleteCategoria/:id', function ($id) {
            (new CategoriaController())->deleteCategoria($id);
        });

        Router::add('GET','/addCarrito', function () {
            (new CarritoController())->addCarrito();
        });

        Router::add('POST','/addCarrito', function () {
            (new CarritoController())->addCarrito();
        });

        Router::add('GET', 'deleteCarrito/:id', function ($id) {
            (new CarritoController())->deleteCarrito($id);
        });

        Router::add('GET', 'deleteCarritoAll/:id', function ($id) {
            (new CarritoController())->deleteCarritoAll($id);
        });

        Router::add('GET', 'sumarCarrito/:id', function ($id) {
            (new CarritoController())->sumarCarrito($id);
        });





        Router::add('GET', '/not-found', function () {
            ErrorController::error404();
        });

        Router::dispatch();
    }
}
