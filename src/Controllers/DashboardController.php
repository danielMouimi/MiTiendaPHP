<?php
namespace Controllers;
use Controllers\CategoriaController;
use Controllers\ProductoController;
use Lib\Pages;


class DashboardController {
    private CategoriaController $category;
    private ProductoController $product;
    private Pages $pages;

    public function __construct() {
        $this->category = new CategoriaController();
        $this->product = new ProductoController();
        $this->pages = new Pages();
    }

    public function index() {
        $cat = $this->category->getCategorias();
        $prod = $this->product->getProductos();
        $this->pages->render('productos/mostrarProductos', ['productos' => $prod,'categorias' => $cat]);
    }
}
