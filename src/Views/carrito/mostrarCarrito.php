
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
            <tr>
                <td><?= $producto ?></td>
                <td><?= $datos["precio"] ?> €</td>
                <td><?= $datos["cantidad"] ?></td>
                <td>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>El carrito está vacío.</p>
<?php endif; ?>

<a href="/carrito/checkout">Ir a pagar</a>