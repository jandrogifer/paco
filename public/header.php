<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PACO COMPRA ESTO!!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1 style="color: white !important; background-color: black; padding: 20px; text-align: center;">
        RECUERDA COSAS A PACO
    </h1>
</header>
<nav>
    <a href="index.php">Inicio</a>
    <a href="registro.php">Registro</a>
    <a href="login.php">Login</a>
    <?php if (isset($_SESSION['usuario'])): ?>
        <a href="carrito.php">Carrito</a>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
   
</nav>
<div class="container">