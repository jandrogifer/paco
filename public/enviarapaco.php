<?php
session_start();
include 'header.php';

// Obtener las frutas del carrito desde la sesión y convertirlas en texto
$frutasCarrito = "No hay productos en el carrito.";

if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    $frutasArray = array_map(function ($producto) {
        return $producto['nombre'] . " (x" . $producto['cantidad'] . ")";
    }, $_SESSION['carrito']);

    $frutasCarrito = implode(", ", $frutasArray);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar a Paco</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Enviar Frutas a Paco</h2>
    <form action="procesar_envio.php" method="POST">
        <div class="form-group">
            <label for="mensaje">Mensaje para Paco:</label>
            <textarea name="mensaje" id="mensaje" rows="5" required><?php echo htmlspecialchars($frutasCarrito); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
    </form>
</body>
</html>

<?php include 'footer.php'; ?>
