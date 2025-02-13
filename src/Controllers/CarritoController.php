<?php
namespace Controllers;
use Lib\Pages;
use Exception;
use Services\ProductoService;
use Models\Producto;

class CarritoController {
    private Pages $pages;
    private ProductoService $productoService;

    public function __construct(){
        $this->pages = new Pages();
        $this->productoService = new ProductoService();
    }

    public function addCarrito($id = null){
        if (isset($id)) {
            $product = $this->productoService->getProducto($id)[0];
            if ($_SESSION['carrito'][$id]['cantidad'] < $product['stock']) {
                $_SESSION['carrito'][$id]['cantidad'] += 1;
            } else {
                $_SESSION['error'] = "No hay más stock disponible.";
            }
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_SESSION['user'])) {
                $product_id = $_POST['product_id'];
                $product = $this->productoService->getProducto($product_id)[0];

                if ($product != null) {
                    if (!isset($_SESSION['carrito'])) {
                        $_SESSION['carrito'] = [];
                    }

                    // Verificar si el producto ya está en el carrito
                    if (!isset($_SESSION['carrito'][$product_id])) {
                        // Agregar nuevo producto al carrito
                        $_SESSION['carrito'][$product_id] = [
                            'nombre' => $product['nombre'],
                            'cantidad' => 1,
                            'precio' => $product['precio'],
                            'stock' => $product['stock'] // Suponiendo que el stock está en la BD
                        ];
                    } else {
                        // Verificar que la cantidad en el carrito no supere el stock disponible
                        if ($_SESSION['carrito'][$product_id]['cantidad'] < $product['stock']) {
                            $_SESSION['carrito'][$product_id]['cantidad'] += 1;
                        } else {
                            $_SESSION['error'] = "No hay más stock disponible.";
                        }
                    }
                }
                header("Location: " . BASE_URL . "addCarrito");
            } else {
                header("Location: " . BASE_URL . "login");
            }
        } else {
            $this->pages->render('carrito/mostrarCarrito');
        }
    }

    public function deleteCarrito($id) {
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] -= 1;

            // Si la cantidad llega a 0, eliminar el producto del carrito
            if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$id]);
            }
        }
        header("Location: " . BASE_URL . "addCarrito");
    }

    public function deleteCarritoAll($id) {
        if (isset($_SESSION['carrito'][$id])) {
                unset($_SESSION['carrito'][$id]);
        }
        header("Location: " . BASE_URL . "addCarrito");
    }

    public function sumarCarrito($id) {
        if (isset($_SESSION['carrito'][$id])) {

            $this->addCarrito($id);
        }
    }
}
