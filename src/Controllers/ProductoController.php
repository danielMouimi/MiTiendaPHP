<?php
namespace Controllers;
use Lib\Pages;
use Models\Producto;
use Services\ProductoService;
use Controllers\CategoriaController;
class ProductoController{
    private Pages $pages;
    private ProductoService $productoService;
    private CategoriaController $categoriaController;

    public function __construct(){
        $this->pages = new Pages();
        $this->productoService = new ProductoService();
        $this->categoriaController = new CategoriaController();
    }

    public function addProducto(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['data']) {
                $_POST['data']['date'] = date('Y-m-d');
                $producto = Producto::fromArray($_POST['data']);
                if($producto->validar()) {

                    $this->productoService->addProducto($producto);

                }else {
                    $_SESSION['errores'] = Producto::getErrores();
                    $this->pages->render('error/formerror',['error'=>$_SESSION['errores']]);
                }
            }else {
                $_SESSION['errores'] = Producto::getErrores();
                $this->pages->render('error/formerror',['error'=>$_SESSION['errores']]);
            }
        }else {

            $categorias = $this->categoriaController->getCategorias();
            $this->pages->render('productos/newProducto', ['categorias'=>$categorias]);
        }
    }

    public function getProductos(){
        return $this->productoService->getProductos();
    }
    public function getProducto($id) {
        return $this->productoService->getProducto($id);
    }

    public function editProducto($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['data']) {
                $_POST['data']['date'] = date('Y-m-d');
                $producto = Producto::fromArray($_POST['data']);
                if($producto->validar()) {
                    $this->productoService->editProducto($id,$producto);
                }else {
                    $_SESSION['errores'] = Producto::getErrores();
                    $this->pages->render('error/formerror',['error'=>$_SESSION['errores']]);
                }
            }
        } else {

            $product = $this->getProducto($id)[0];
            $categorias = $this->categoriaController->getCategorias();
            $this->pages->render('productos/editarProductos', ['product'=>$product,'categorias'=>$categorias]);
        }
    }

    public function deleteProducto($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $producto = Producto::fromArray($_POST['data']);
            $this->productoService->deleteProducto($id);
        }else {
            $this->pages->render('productos/deleteProductos', ['product'=>$this->getProducto($id)]);
        }
    }

    public function existe($nombre) {
        return $this->productoService->existe($nombre);
    }

    public function getProductosbyCat($id){
        $productos = $this->productoService->getbyCategoria($id);
        $categorias = $this->categoriaController->getCategorias();
        $this->pages->render('productos/mostrarProductos', ['productos'=>$productos,'categorias'=>$categorias]);
    }





}

