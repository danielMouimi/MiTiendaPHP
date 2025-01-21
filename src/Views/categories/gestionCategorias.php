<style>
    h2 a {
        text-decoration: none;
        color: #28a745;
        border: 2px solid #28a745;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    h2 a:hover {
        background-color: #218838;
        color: white;
    }
    div {
        margin: 20px 0;
    }

    div h3 {
        font-size: 20px;
        color: #343a40;
        margin-bottom: 10px;
    }

    div ul {
        list-style-type: none;
        padding: 0;
        margin: 0 0 20px 0;
    }

    div ul li {
        display: inline-block;
        margin-right: 15px;
    }

    div ul li a {
        text-decoration: none;
        color: #ffc107;
        border: 1px solid #ffc107;
        padding: 5px 10px;
        border-radius: 4px;
        transition: background-color 0.3s, color 0.3s;
    }

    div ul li a:hover {
        background-color: #e0a800;
        color: white;
    }

</style>

<?php echo "<h2><a href='".BASE_URL."newCategory'>Crear Categoria</a></h2>"; ?>

<div>
        <?php foreach ($categorias as $category): ?>
            <h3><?= htmlspecialchars($category['nombre']) ?></h3>
        <ul>
            <li><a href="<?=BASE_URL?>editCategoria/<?=htmlspecialchars($category['id'])?>">Editar Categoria</a></li>
            <li><a href="<?=BASE_URL?>deleteCategoria/<?=htmlspecialchars($category['id'])?>">Eliminar Categoria</a></li>
        </ul>
        <?php endforeach; ?>
</div>

