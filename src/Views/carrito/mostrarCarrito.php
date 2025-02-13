<h2>Carrito de Compras</h2>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
        <?php foreach ($_SESSION['carrito'] as $producto => $datos): ?>
            <?php if (!empty($datos)): // Evita errores si hay datos vacíos ?>
                <tr>
                    <td><?= htmlspecialchars($datos["nombre"]) ?></td>
                    <td><?= htmlspecialchars($datos["precio"]) ?> €</td>
                    <td><?= htmlspecialchars($datos["cantidad"]) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>deleteCarrito/<?= $producto ?>">restar</a>
                        <a href="<?= BASE_URL ?>deleteCarritoAll/<?= $producto ?>"> borrar</a>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>sumarCarrito/<?= $producto ?>">sumar</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>El carrito está vacío.</p>
<?php endif; ?>

<a href="/carrito/checkout">Ir a pagar</a>
