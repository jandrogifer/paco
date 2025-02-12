<?php include 'header.php'; ?>

    <div class="form-container">
        <h2>Registro</h2>
        <form action="procesar_registro.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" placeholder="Tu nombre" required>
            </div>

            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" placeholder="ejemplo@correo.com" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" placeholder="aquipass" required>
            </div>

            <button type="submit" class="btn">Registrarse</button>
        </form>
    </div>
<?php include 'footer.php'; ?>
