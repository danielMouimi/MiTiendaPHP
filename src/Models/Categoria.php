<?php
namespace Models;
use Controllers\CategoriaController;

class Categoria {
    protected static array $errores = [];
    private CategoriaController $categoriaController;
    public function __construct(
        private int|null $id,
        private string $nombre
    ) {
        $this->categoriaController = new CategoriaController();
    }
    public static function getErrores() {
        return self::$errores;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function validar():bool {
        self::$errores = [];

        if (empty($this->nombre)) {
            self::$errores['nombre'] = "El nombre es requerido";
        }
        if ($this->categoriaController->existe(strtolower($this->nombre))) {

            self::$errores['nombre'] = "La categoria ya existe";
        }
        if ($this->categoriaController->contieneProductos($this->id)) {
            self::$errores['nombre'] = "La categoria contiene productos, no se puede eliminar ni editar";
        }



        return empty(self::$errores);
    }

    public static function fromArray(array $data):Categoria
    {
        return new Categoria(
            id: $data['id'] ?? null,
            nombre: $data['nombre'],
        );
    }

}
