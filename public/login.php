<?php include 'header.php'; ?>
    <h2>Iniciar Sesión</h2>
    <form action="procesar_login.php" method="POST">
    <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>
        </div>
        <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Ingresar</button>
    </form>
<?php include 'footer.php'; ?>
