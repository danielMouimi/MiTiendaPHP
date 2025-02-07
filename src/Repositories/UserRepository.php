<?php
namespace Repositories;
use Lib\BaseDatos;
use Models\User;
use Lib\Pages;
use PDO;
class UserRepository {
    private BaseDatos $database;
    private Pages $pages;
    public function __construct()
    {
       $this->database = new BaseDatos();
       $this->pages = new Pages();
    }

    public function registroUser(User $usuario) {
            try {
                $insert = $this->database->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, rol) 
            VALUES(:name, :lastName, :email, :password, :role)");


                $insert->bindValue(":name", $usuario->getNombre());
                $insert->bindValue(":lastName", $usuario->getApellido());
                $insert->bindValue(":email", $usuario->getEmail());
                $insert->bindValue(":password", $usuario->getPassword());
                $insert->bindValue(":role", $usuario->getRol());

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

        public function loginUser($email, $password) {
            try {
                $query = $this->database->prepare("SELECT * FROM usuarios WHERE email = :email");
                $query->bindValue(":email", $email, PDO::PARAM_STR);
                $query->execute();

                $result = $query->fetch(PDO::FETCH_ASSOC);

                // Verificar si el usuario existe y si la contraseña coincide
                if ($result && password_verify($password, $result['password'])) {
                    $_SESSION['user'] = $result;
                return true;
                }

                return false; // Credenciales inválidas
            } catch (PDOException $e) {
                error_log("Error al logear: " . $e->getMessage());
                return false;
            } finally {
                if (isset($query)) {
                    $query->closeCursor();
                    $query = null;
                }
            }
        }
}