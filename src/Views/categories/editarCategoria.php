<style>
    form {
        background-color: #f8f9fa;
        padding: 20px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        max-width: 400px;
        margin: 20px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #343a40;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form textarea,
    form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 16px;
    }

    form textarea {
        resize: vertical;
        min-height: 100px;
    }

    form input[type="submit"],
    form button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    form input[type="submit"]:hover,
    form button:hover {
        background-color: #0056b3;
    }

</style>

<div class="edit-product-form">
    <h2>Editar Producto</h2>
    <form action="<?=BASE_URL . "editCategoria/" . htmlspecialchars($categoria['id'])?>" method='POST'>
        <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id']) ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="data[nombre]" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>


        <button type="submit">Actualizar Categoria</button>
    </form>
</div>
