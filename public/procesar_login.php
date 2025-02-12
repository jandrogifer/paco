<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nombre, correo, pass FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $correo, $hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['correo'] = $correo; // Guardar el correo en la sesión

            header("Location: index.php");
            exit();
        } else {
            echo "⚠️ Contraseña incorrecta.";
        }
    } else {
        echo "⚠️ Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "❌ Acceso no permitido.";
}
?>