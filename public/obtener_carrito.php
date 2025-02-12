<?php
session_start();

if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        echo "<li>🍏 " . htmlspecialchars($producto['nombre']) . " - x" . $producto['cantidad'] . "</li>";
    }
} else {
    echo "<li>Carrito vacío</li>";
}
?>
