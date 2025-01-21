<?php
namespace Models;

class User {
    protected static array $errores =[];
    public function __construct(
        private int|null $id,
        private string $nombre,
        private string $apellido,
        private string $email,
        private string $password,
        private string $rol,
    ) {
    }
    public function getId() {
        return $this->id;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getRol() {
        return $this->rol;
    }
    public static function getErrores() {
        return self::$errores;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }

    public static function setErrores($errores) {
        self::$errores = $errores;
    }

    public function validar():bool {
        self::$errores = [];

        if (empty($this->nombre)) {
            self::$errores['nombre'] = "El nombre es requerido";
        }


        return empty(self::$errores);
    }


    public static function fromArray(array $data):User
    {
        return new User(
            id: $data['id'] ?? null,
            nombre: $data['name'] ?? '',
            apellido: $data['lastname'] ?? '',
            email: $data['email'] ?? '',
            password: $data['password'] ?? '',
            rol: $data['rol'] ?? 'user'
        );
    }




}