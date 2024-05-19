
<?php


$mostrarPie = false;

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../public/css/productos.css">
    <title>Carrito de Compras</title>
</head>

<body>
    <div class="h1">
        <h1>Carrito de Compras</h1>
    </div>


    <div class="carrito">
        <?php if (!empty($cart)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($cart as $cart_item):
                        $product = $cart_item['product'];
                        $quantity = $cart_item['quantity'];
                        $total += $cart_item['total_price'];
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product->nombre_producto); ?></td>
                            <td><?php echo htmlspecialchars($product->precio); ?>€</td>
                            <td><?php echo htmlspecialchars($quantity); ?></td>
                            <td><?php echo htmlspecialchars($cart_item['total_price']); ?>€</td>
                            <td>
                                <form action="/carrito/eliminar" method="post" style="display:inline;">
                                    <input type="hidden" name="producto_id"
                                        value="<?php echo htmlspecialchars($product->ID_producto); ?>">
                                    <button type="submit" class="remove-product">Eliminar producto</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total del Carrito:</strong></td>
                        <td colspan="2"><?php echo htmlspecialchars($total); ?>€</td>
                    </tr>
                </tfoot>
            </table>
            <div class="form-container">
                <form action="/carrito/checkout" method="post">
                    <button type="submit" class="btn-pago">Proceder al Pago</button>
                </form>
                <form action="/carrito/eliminar-todos" method="post">
                    <button type="submit" class="clean-carrito">Vaciar Carrito</button>
                </form>
            </div>
        <?php else: ?>
            <p class="clean-text">El carrito está vacío.</p>
        <?php endif; ?>
    </div>
</body>

</html>