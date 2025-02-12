<?php
session_start();
$_SESSION['carrito'] = []; // Vaciar el carrito

// Redirigir automáticamente a index.php
header("Location: index.php");
exit();
?>
