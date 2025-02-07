<?php
namespace Repositories;
use Lib\BaseDatos;
use Models\Categoria;
use Lib\Pages;
use PDO;

class CategoriaRepository {
    private BaseDatos $database;
    private Pages $pages;
    public function __construct()
    {
        $this->database = new BaseDatos();
        $this->pages = new Pages();
    }

    public function addCategoria(Categoria $categoria) {
        try {
            $insert = $this->database->prepare("INSERT INTO categorias (id,nombre) 
            VALUES(:id,:nombre)");

            $insert->bindValue(":id", $categoria->getId());
            $insert->bindValue(":nombre", strtolower($categoria->getNombre()));

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
                $insert = null;
            }
        }

    }

    public function getCategorias() {
        try {
            $select = $this->database->prepare("SELECT * FROM categorias");
            $select->execute();
            return $select->fetchAll();
        }catch (\PDOException $e) {
            error_log("Error al ejecutar: " . $e->getMessage());
            return false;
        } finally {
            if (isset($select)) {
                $select->closeCursor();
                $select = null;
            }
        }
    }
    public function getCategoria($id) {
        try {
            $select = $this->database->prepare("SELECT * FROM categorias WHERE id = :id");
            $select->bindValue(":id", $id);
            $select->execute();
            return $select->fetch();
        }catch (\PDOException $e) {
            error_log("Error al ejecutar: " . $e->getMessage());
            return false;
        } finally {
            if (isset($select)) {
                $select->closeCursor();
                $select = null;
            }
        }
    }

    public function existe($nombre) {
        $select = $this->database->prepare("SELECT * FROM categorias WHERE nombre = :nombre");
        $select->bindValue(":nombre", $nombre);
        $select->execute();
        if($select->rowCount() > 0) {
            $select->closeCursor();
            return true;
        }else {
            $select->closeCursor();
            $select = null;
            return false;
        }
    }

    public function contieneProductos($id) {
        $select = $this->database->prepare("SELECT * FROM productos WHERE categoria_id = :id");
        $select->bindValue(":id", $id);
        $select->execute();
        if($select->rowCount() == 0) {
            $select->closeCursor();
            return false;
        }else {
            $select->closeCursor();
            $select = null;
            return true;
        }
    }

    public function editCategoria($id,$categoria){

        try {
        $update = $this->database->prepare("UPDATE categorias SET nombre = :nombre WHERE id = :id");
        $update->bindValue(":id", $id);

        $update->bindValue(":nombre", strtolower($categoria));
        $update->execute();
        return true;
        }  catch (PDOException $e) {
            error_log("Error : " . $e->getMessage());
            return false;
        } finally {
            if (isset($update)) {
                $update->closeCursor();
                $update = null;
            }
        }
    }

    public function deleteCategoria($id) {
        try{
        $delete = $this->database->prepare("DELETE FROM categorias WHERE id = :id");
        $delete->bindValue(":id", $id);
        $delete->execute();
        return true;
        }  catch (PDOException $e) {
            error_log("Error al crear el usuario: " . $e->getMessage());
            return false;
        } finally {
            if (isset($delete)) {
                $delete->closeCursor();
                $delete = null;
            }
        }
    }
}