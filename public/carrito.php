<?php
session_start(); 
include 'config.php';

// Asegurar que $_SESSION['carrito'] es un array
if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Procesar producto añadido al carrito
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['producto_id'])) {
    $producto_id = intval($_POST['producto_id']);

    // Conectar a la base de datos y obtener el producto
    $query = "SELECT id, producto FROM productos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();

        // Verificar si ya existe en el carrito
        $existe = false;

        foreach ($_SESSION['carrito'] as $key => $item) {
            if (is_array($item) && isset($item['id']) && $item['id'] === $producto_id) {
                $_SESSION['carrito'][$key]['cantidad']++;
                $existe = true;
                break;
            }
        }

        // Si no existe, lo añadimos
        if (!$existe) {
            $_SESSION['carrito'][] = [
                'id' => $producto['id'],
                'nombre' => $producto['producto'],
                'cantidad' => 1
            ];
        }

        echo json_encode(["success" => true, "message" => "✅ Has añadido \"{$producto['producto']}\" al carrito 🛒"]);
    } else {
        echo json_encode(["success" => false, "message" => "❌ Error: Producto no encontrado."]);
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        h1 { color: #333; }
        .carrito { background: #f9f9f9; padding: 20px; border-radius: 10px; display: inline-block; text-align: left; }
        .carrito ul { list-style: none; padding: 0; }
        .carrito li { padding: 5px; font-size: 18px; }
        .btn { display: inline-block; padding: 10px 15px; background: red; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

    <h1>🛒 Carrito de Compras</h1>

    <div class="carrito">
        <h3>Productos en tu carrito:</h3>
        <ul>
            <?php if (!empty($_SESSION['carrito']) && is_array($_SESSION['carrito'])): ?>
                <?php foreach ($_SESSION['carrito'] as $producto): ?>
                    <?php if (is_array($producto) && isset($producto['nombre'], $producto['cantidad'])): ?>
                        <li>🍏 <?php echo htmlspecialchars($producto['nombre']); ?> - Cantidad: <?php echo $producto['cantidad']; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Tu carrito está vacío.</li>
            <?php endif; ?>
        </ul>

        <form action="vaciar_carrito.php" method="POST">
            <button type="submit" class="btn">Vaciar carrito</button>
        </form>
    </div>

    <p><a href="index.php">Volver a la tienda</a></p>

</body>
</html>
<?php include 'footer.php'; ?>