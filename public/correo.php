<?php
// Evita el error asegurando que session_start() solo se ejecuta si no hay una sesión activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtener los productos del carrito en formato texto
$frutasCarrito = "No hay productos en el carrito.";

if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    $frutasArray = array_map(function ($producto) {
        return "- " . htmlspecialchars($producto['nombre']) . " (x" . $producto['cantidad'] . ")";
    }, $_SESSION['carrito']);

    $frutasCarrito = "Lista de productos en el carrito:\n" . implode("\n", $frutasArray);
}
?>

<h2>Enviar un Correo 📩</h2>
<form action="procesar_correo.php" method="POST">
    <div class="form-group">
        <label for="email">Destinatario:</label>
        <input type="email" name="email" value="<?php echo isset($_SESSION['correo']) ? htmlspecialchars($_SESSION['correo']) : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="asunto">Asunto:</label>
        <input type="text" name="asunto" value="Paco joder compra esto" required>
    </div>
    <div class="form-group">
        <label for="mensaje">Mensaje:</label>
        <textarea name="mensaje" id="mensaje" rows="15" cols="100" required><?php echo htmlspecialchars("hola\n\n" . $frutasCarrito); ?></textarea>
    </div>
    <button type="submit" class="btn">Enviar Correo</button>
</form>
