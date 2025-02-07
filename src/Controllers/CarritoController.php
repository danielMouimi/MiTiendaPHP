<?php
namespace Controllers;
use Lib\Pages;
use Exception;
use Services\ProductoService;
use Models\Producto;

class CarritoController{
    private Pages $pages;
    private ProductoService $productoService;
    private Producto $producto;

    public function __construct(){
        $this->pages = new Pages();
        $this->productoService = new ProductoService();
    }

    public function addCarrito(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $product_id = $_POST['product_id'];
            $product = $this->productoService->getProducto($product_id)[0];
            if($product != null){
                if(!isset($_SESSION['carrito'])){
                    $_SESSION['carrito'] = [];
                }
            }


            if(!isset($_SESSION['carrito'][$product_id])){
                $_SESSION['carrito'][$product_id] = [];
                $_SESSION['carrito'][$product_id]['cantidad'] = 1;
                $_SESSION['carrito'][$product_id]['precio'] = $product->getPrecio();
            }else {
                $_SESSION['carrito'][$product_id]['cantidad'] += 1;
            }
            header("Location: ". BASE_URL);






        }else {
            $this->pages->render('carrito/mostrarCarrito');
        }
    }
}