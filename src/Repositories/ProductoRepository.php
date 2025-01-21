<?php
namespace Repositories;
use Lib\BaseDatos;
use Models\Producto;
use Lib\Pages;
use PDO;

class ProductoRepository
{
    private BaseDatos $database;
    private Pages $pages;

    public function __construct()
    {
        $this->database = new BaseDatos();
        $this->pages = new Pages();
    }

    function addProducto(Producto $producto) {
        try {
            $insert = $this->database->prepare("INSERT INTO productos (id,categoria_id,nombre,descripcion,precio,stock,oferta,fecha,imagen) 
            VALUES(:id,:categoria_id,:nombre,:descripcion,:precio,:stock,:oferta,:datetime,:imagen)");

            $insert->bindValue(":id", $producto->getId());
            $insert->bindValue(":categoria_id", $producto->getCategoriaId());
            $insert->bindValue(":nombre", strtolower($producto->getNombre()));
            $insert->bindValue(":descripcion", $producto->getDescripcion());
            $insert->bindValue(":precio", $producto->getPrecio());
            $insert->bindValue(":stock", $producto->getStock());
            $insert->bindValue(":oferta", $producto->getOferta());
            $insert->bindValue(":datetime",$producto->getDatetime());
            $insert->bindValue(":imagen", $producto->getImagen());



            try {
                $insert->execute();

            }catch (\PDOException $e) {
                die("error al ejecutar" . $e->getMessage());
            }
            return true;
        } catch (PDOException $e) {
            error_log("Error al crear el usuario: " . $e->getMessage());
            return false;
        } finally {
            if (isset($insert)) {
                $insert->closeCursor();
                header("location: " . BASE_URL );
            }
        }
    }

    public function getProductos() {
     $select = $this->database->prepare("SELECT * FROM productos");
     $select->execute();
     return $select->fetchAll();
    }
    public function getProducto($id) {
        $select = $this->database->prepare("SELECT * FROM productos WHERE id = :id");
        $select->bindValue(":id", $id);
        $select->execute();
        return $select->fetchAll();
    }

    public function editProducto($id,$producto) {
        try {
            $update = $this->database->prepare("UPDATE productos SET 
                     nombre = :nombre,
                     descripcion = :descripcion,
                     precio = :precio,
                     stock = :stock,
                     oferta = :oferta,
                     categoria_id = :categoria_id
                    where id = :id");
            $update->bindValue(":nombre", strtolower($producto->getNombre()));
            $update->bindValue(":descripcion", $producto->getDescripcion());
            $update->bindValue(":precio", $producto->getPrecio());
            $update->bindValue(":stock", $producto->getStock());
            $update->bindValue(":oferta", $producto->getOferta());
            $update->bindValue(":categoria_id", $producto->getCategoriaId());
            $update->bindValue(":id", $id);
            $update->execute();
            return true;
        }  catch (PDOException $e) {
            error_log("Error al crear el usuario: " . $e->getMessage());
            return false;
        } finally {
            if (isset($update)) {
                $update->closeCursor();
                header("location: " . BASE_URL );
            }
        }

    }

    public function deleteProducto($id) {
        try {
        $delete = $this->database->prepare("DELETE FROM productos WHERE id = :id");
        $delete->bindValue(":id", $id);
        $delete->execute();
        return true;

        }  catch (PDOException $e) {
            error_log("Error al crear el usuario: " . $e->getMessage());
            return false;
        } finally {
            if (isset($delete)) {
                $delete->closeCursor();
                header("location: " . BASE_URL );
            }
        }
    }

    public function existe($nombre) {
        $select = $this->database->prepare("SELECT * FROM productos WHERE nombre = :nombre");
        $select->bindValue(":nombre", $nombre);
        $select->execute();
        if ($select->rowCount() > 0) {
            return true;
        }else {
            return false;
        }
    }

    public function getbyCategoria($categoria_id) {
        $select = $this->database->prepare("SELECT * FROM productos WHERE categoria_id = :categoria_id");
        $select->bindValue(":categoria_id", $categoria_id);
        $select->execute();
        return $select->fetchAll();
    }



}