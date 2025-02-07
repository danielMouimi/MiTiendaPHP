<?php
namespace Controllers;
use Lib\Pages;
use Models\Categoria;
use Services\CategoriaService;

class CategoriaController{
    private Pages $pages;
    private CategoriaService $categoriaService;
    private DashboardController $dashboardController;

    public function __construct(){
        $this->pages = new Pages();
        $this->categoriaService = new CategoriaService();
    }

    public function addCategoria(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['data']) {
                $categoria = Categoria::fromArray($_POST['data']);
                if($categoria->validar()) {
                    $this->categoriaService->addCategoria($categoria);
                    header("Location: ". BASE_URL);

                } else {
                    $_SESSION['errores'] = Categoria::getErrores();
                    $this->pages->render('error/formerror',['error'=>$_SESSION['errores']]);
                }
            }else {

            }
        }else {
            $this->pages->render('categories/newCategory');
        }
    }

    public function getCategorias(){
        return $this->categoriaService->getCategorias();
    }

    public function getCategoria($id){
        return $this->categoriaService->getCategoria($id);
    }

    public function existe($nombre) {
        return $this->categoriaService->existe($nombre);
    }

    public function editCategoria($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['data']) {
                $categoria = Categoria::fromArray($_POST['data']);
                if($categoria->validar()) {
                    $this->categoriaService->editCategoria($id, $_POST['data']['nombre']);
                    header("Location: ". BASE_URL);
                }else {
                    $_SESSION['errores'] = Categoria::getErrores();
                    $this->pages->render('error/formerror',['error'=>$_SESSION['errores']]);
                }
            }
        } else {

            $this->pages->render('categories/editarCategoria', ['categoria' => $this->categoriaService->getCategoria($id)] );
        }
    }

    public function contieneProductos($id){
        return $this->categoriaService->contieneProductos($id);
    }

    public function deleteCategoria($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->categoriaService->deleteCategoria($id);
            header("Location: ". BASE_URL);
        }else {
            $this->pages->render('categories/deleteCategoria', ['categoria' => $this->categoriaService->getCategoria($id)] );
        }
    }


}