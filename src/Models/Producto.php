<?php
namespace Models;
use Controllers\ProductoController;

class Producto {
    protected static array $errores = [];
    private ProductoController $controller;

    public function __construct(
        private int|null $id,
        private int $categoria_id,
        private string $nombre,
        private string $descripcion,
        private string $precio,
        private int $stock,
        private string $oferta,
        private string $datetime,
        private string|null $imagen,
    ) {
        $this->controller = new ProductoController();
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

    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }

    public function setCategoriaId(int $categoria_id): void
    {
        $this->categoria_id = $categoria_id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getPrecio(): string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): void
    {
        $this->precio = $precio;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getOferta(): string
    {
        return $this->oferta;
    }

    public function setOferta(string $oferta): void
    {
        $this->oferta = $oferta;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getDatetime(): string
    {
        return $this->datetime;
    }

    public function setDatetime(object $datetime): void
    {
        $this->datetime = $datetime;
    }

    public function validar():bool {
        self::$errores = [];

        if (empty($this->nombre)) {
            self::$errores['nombre'] = "El nombre es requerido";
        }
        if (empty($this->descripcion)) {
            self::$errores['descripcion'] = "La descripcion es requerido";
        }
        if (empty($this->precio)) {
            self::$errores['precio'] = "El precio es requerido";
        }
        if (empty($this->categoria_id)) {
            self::$errores['categoria_id'] = "La categoria es requerido";
        }
        if (empty($this->oferta)) {
            $this->oferta = "no hay oferta";
        }
        if ($this->controller->existe(strtolower($this->nombre))) {
            self::$errores['nombre'] = "El nombre ya existe";
        }

        return empty(self::$errores);
    }


    public static function fromArray(array $data):Producto
    {
        return new Producto(
            id: $data['id'] ?? null,
            categoria_id: $data['categoria_id'] ?? null,
            nombre: $data['nombre'] ?? null,
            descripcion: $data['descripcion'] ?? null,
            precio: $data['precio'] ?? null,
            stock: $data['stock'] ?? null,
            oferta: $data['oferta'] ?? null,
            imagen: $data['imagen'] ?? null,
            datetime: $data['date'] ?? null,
        );
    }
}