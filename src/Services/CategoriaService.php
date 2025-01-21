<?php
namespace Services;
use Repositories\CategoriaRepository;

class CategoriaService {
    private CategoriaRepository $repository;

    public function __construct() {
        $this->repository = new CategoriaRepository();
    }

    public function addCategoria($categoria) {
        $this->repository->addCategoria($categoria);
    }

    public function getCategorias() {
        return $this->repository->getCategorias();
    }

    public function getCategoria($id) {
        return $this->repository->getCategoria($id);
    }
    public function existe($nombre) {
        return $this->repository->existe($nombre);
    }
    public function contieneProductos($id) {
        return $this->repository->contieneProductos($id);
    }

    public function editCategoria($id, $categoria) {
        $this->repository->editCategoria($id, $categoria);
    }

    public function deleteCategoria($id) {
        $this->repository->deleteCategoria($id);
    }
}
