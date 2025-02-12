<?php 
session_start();
include 'header.php'; 
include 'config.php'; 
?>

<h2>🛍 Resumen de tu compra</h2>

<div class="resumen-pago">
    <h3>Productos en tu pedido:</h3>
    <ul>
        <?php 
        $total = 0;

        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $producto) {
                $subtotal = $producto['cantidad'] * 2.50; // Precio fijo de 2.50€ por producto
                $total += $subtotal;
                echo "<li>🍏 " . htmlspecialchars($producto['nombre']) . " - x" . $producto['cantidad'] . " → " . number_format($subtotal, 2) . " €</li>";
            }
        } else {
            echo "<li>No hay productos en el carrito.</li>";
        }
        ?>
    </ul>

    <h3>Total a pagar: <strong><?php echo number_format($total, 2); ?> €</strong></h3>
    <p><strong>Número de cuenta para el pago:</strong> <br> IBAN: ES12 3456 7890 1234 5678 9012</p>

    <form action="vaciar_carrito.php" method="POST">
        <button type="submit" class="btn btn-danger">Cancelar compra</button>
    </form>

    <br><br>

    <form action="factura.php" method="POST">
        <button type="submit" class="btn btn-success">Descargar Factura 📄</button>
    </form>
</div>

<p><a href="index.php">Volver a la tienda</a></p>

<?php include 'footer.php'; ?>
