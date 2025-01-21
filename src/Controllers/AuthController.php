<?php
namespace Controllers;
use Lib\Pages;
use Models\User;
use Services\UserService;
use http\Exception;

class AuthController {
    private Pages $pages;
    public function __construct() {
        $this->pages = new Pages();
        $this->userService = new UserService;
    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($_POST['data']) {
                $usuario = User::fromArray($_POST['data']);
                if ($usuario->validar()) {
                    $password = password_hash($usuario->getPassword(), PASSWORD_BCRYPT, ['cost' => 5]);
                    $usuario->setPassword($password);

                    try {
                        $this->userService->registrarUser($usuario);
                    }catch (\Exception $e) {
                        $_SESSION['register'] = "fail";
                        $_SESSION['errores'] = $e->getMessage();
                    }

                }else {

                    $_SESSION['register'] = "fail";
                    $_SESSION['errores'] = User::getErrores();
                }
            }else {
                $_SESSION["register"] = "fail";
            }
        }else {
            $this->pages->render('Auth/register');
        }

    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data'] ?? null;

            if (!$data || !isset($data['email'], $data['password'])) {
                $_SESSION['login'] = 'fail';
                $_SESSION['errors'] = 'Todos los campos son obligatorios.';
                $this->pages->render('Auth/login'); // Renderiza nuevamente el formulario con errores
                return;
            }

            $email = $data['email'];
            $password = $data['password'];

            try {
                // Llama al método loginUser del servicio para verificar credenciales
                $isLoggedIn = $this->userService->login($email, $password);

            } catch (Exception $e) {
                error_log('Error al iniciar sesión: ' . $e->getMessage());
                $_SESSION['login'] = 'fail';
                $_SESSION['errors'] = 'Ocurrió un error al procesar el inicio de sesión.';
                $this->pages->render('Auth/login'); // Renderiza nuevamente el formulario con errores
            }
        } else {
            $this->pages->render('Auth/login'); // Muestra el formulario de inicio de sesión
        }
    }


    public function cerrarsesion() {
        session_destroy();
        header('Location: '.BASE_URL);
    }

}