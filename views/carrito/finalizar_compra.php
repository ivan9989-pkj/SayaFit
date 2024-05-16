<?php include __DIR__ . '/../layout.php'; ?>

<h2>Finalizar Compra</h2>

<form method="POST" action="/carrito/finalizar">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" required>

    <label for="metodo_pago">Método de Pago:</label>
    <select name="metodo_pago" id="metodo_pago">
        <option value="tarjeta">Tarjeta de Crédito</option>
        <option value="paypal">PayPal</option>
    </select>

    <button type="submit">Confirmar Compra</button>
</form>

<?php include __DIR__ . '/../footer.php'; ?>
