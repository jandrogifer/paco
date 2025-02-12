<?php
include 'config.php'; // Importar la conexión a la base de datos

// Comprobar si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

    // Verificar que el usuario o el correo no existan ya en la base de datos
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ? OR correo = ?");
    $stmt->bind_param("ss", $usuario, $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "⚠️ Error: El usuario o correo ya están registrados.";
    } else {
        // Insertar usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, usuario, correo, pass) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $usuario, $correo, $password);

        if ($stmt->execute()) {
            echo "✅ Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
        } else {
            echo "❌ Error en el registro: " . $conn->error;
        }
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "❌ Acceso no permitido.";
}
?>
