<?php
namespace Services;
use Repositories\ProductoRepository;
class ProductoService{
    private ProductoRepository $repository;

    public function __construct() {
        $this->repository = new ProductoRepository();
    }

    public function addProducto($producto){
        $this->repository->addProducto($producto);
    }
    public function getProductos(){
        return $this->repository->getProductos();
    }
    public function getProducto($id){
        return $this->repository->getProducto($id);
    }
    public function editProducto($id,$producto){
        $this->repository->editProducto($id,$producto);
    }
    public function deleteProducto($id){
        $this->repository->deleteProducto($id);
    }
    public function existe($nombre){
        return $this->repository->existe($nombre);
    }
    public function getbyCategoria($categoria){
        return $this->repository->getbyCategoria($categoria);
    }

}