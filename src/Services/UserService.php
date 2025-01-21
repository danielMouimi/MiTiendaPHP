<?php
namespace Services;
use Repositories\UserRepository;
use Repositories\UsuarioRepository;
use Models\User;

class UserService {
    private UserRepository $userRepository;
    public function __construct() {

        $this->userRepository = new UserRepository;

    }
    public function registrarUser(User $user) {
        $this->userRepository->registroUser($user);
    }
    public function login($email, $password) {
        return $this->userRepository->loginUser($email, $password);
    }
}
