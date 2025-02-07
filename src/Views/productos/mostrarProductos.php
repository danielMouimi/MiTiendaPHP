<style>





    .productos {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin: 20px 0;
    }

    .producto {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin: 15px;
        padding: 20px;
        text-align: center;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .producto img {
        max-width: 50vw;
        max-height: 50vh;
        height: auto;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
    }

    .producto h2 {
        font-size: 18px;
        margin: 15px 0;
        color: #343a40;
    }

    .producto p {
        color: #495057;
    }

    .producto a {
        text-decoration: none;
        color: #007bff;
        display: inline-block;
        margin-top: 10px;
        padding: 8px 16px;
        border: 1px solid #007bff;
        border-radius: 4px;
        transition: background-color 0.3s, color 0.3s;
    }

    .producto a:hover {
        background-color: #0056b3;
        color: white;
    }

    .producto:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    div ul {
        list-style-type: none;
        padding: 0;
        margin: 20px 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    div ul li {
        margin: 10px;
    }

    div ul li a {
        text-decoration: none;
        color: #007bff;
        padding: 10px 15px;
        border: 1px solid #007bff;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    div ul li a:hover {
        background-color: #0056b3;
        color: white;
    }

</style>

<div>
    <h2>Categorias:</h2>
    <ul>
        <?php foreach ($categorias as $category): ?>
            <li><a href="<?= BASE_URL . 'category/' . $category['id'] ?>"><?= htmlspecialchars($category['nombre']) ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>


<h2>Productos</h2>
<div class="productos">
    <?php foreach ($productos as $producto): ?>
        <div class="producto">
            <img src="<?= $producto['imagen'] ?  htmlspecialchars($producto['imagen']) : BASE_URL . 'public/img/notfound.jpg' ?>" alt="<?= htmlspecialchars($producto['descripcion']) ?>">
            <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
            <p>Precio: $<?= htmlspecialchars($producto['precio']) ?></p>


            <form action="<?=BASE_URL?>addCarrito" method="post">
                <input type="hidden" name="product_id" value="<?= $producto['id'] ?>">
                <button type="submit">Comprar</button>
            </form>

            <?php if(isset($_SESSION['user'])): ?>
            <?php if ($_SESSION['user']['rol'] == 'admin') : ?>
            <p><a href=<?=BASE_URL . "editProducto/" . htmlspecialchars($producto['id'])?>>Editar Producto</a></p>
            <p><a href=<?=BASE_URL . "deleteProducto/" . htmlspecialchars($producto['id'])?>>Eliminar Producto</a></p>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>