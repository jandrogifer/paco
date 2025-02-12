<?php
include 'config.php';

$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$query = "SELECT * FROM productos LIMIT 3 OFFSET $offset";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="producto">
        <h4><?php echo htmlspecialchars($row['producto']); ?></h4>
        <p><strong>Precio:</strong> <?php echo number_format($row['precio'], 2); ?> €</p>
        <form class="add-to-cart-form">
            <input type="hidden" name="producto_id" value="<?php echo $row['id']; ?>">
            <button type="button" class="btn add-to-cart-btn">Añadir al carrito 🛒</button>
        </form>
    </div>
<?php endwhile; ?>
