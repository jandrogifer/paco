<?php
$host = "web_mariadb"; // Nombre del servicio de la base de datos en docker-compose
$usuario = "webuser"; // Usuario que creaste en MariaDB
$password = "webpassword"; // Contraseña definida en docker-compose
$base_datos = "webdb"; // Base de datos que definiste


// Crear conexión
$conn = new mysqli($host, $usuario, $password, $base_datos);

// Comprobar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
