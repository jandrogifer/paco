<?php 
session_start();
include 'header.php'; 
include 'config.php'; 
?>

<?php if (isset($_SESSION['usuario'])): ?>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?> 👋</h2>
    <p><a href="logout.php">Cerrar sesión</a></p>
    <?php include 'correo.php'; ?>

    <!-- Carrito flotante -->
    <div id="carrito" class="carrito-flotante">
        <h3>🛒 Mi Carrito</h3>
        <ul id="lista-carrito">
            <!-- Se actualizará dinámicamente con AJAX -->
        </ul>
        <button id="vaciar-carrito" class="btn btn-danger">Vaciar carrito</button>
        <br><br>
        <a href="pago.php" class="btn btn-success">Pagar Ya 💳</a>
        <br><br>
        <a href="index.php" class="btn btn-success">Enviar a Paco 💳</a>
    </div>

    <h3>Lista de Frutas 🍎🍌🍊</h3>

    <div class="productos-container" id="productos">
        <?php 
        $query = "SELECT * FROM productos LIMIT 3"; 
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
    </div>

    <!-- Botón "Ver más" -->
    <button id="verMas" class="btn btn-vermas">Ver más ⬇️</button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            var offset = 3;

            $("#verMas").click(function(){
                $.ajax({
                    url: "cargar_mas.php",
                    type: "POST",
                    data: { offset: offset },
                    success: function(data){
                        if (data.trim() !== "") {
                            $("#productos").append(data);
                            offset += 3;
                        } else {
                            $("#verMas").hide();
                        }
                    },
                    error: function(){
                        alert("❌ Error: No se pudieron cargar más productos.");
                    }
                });
            });

            // Añadir producto al carrito
            $(document).on("click", ".add-to-cart-btn", function(){
                var producto_id = $(this).siblings("input[name='producto_id']").val();
                $.ajax({
                    url: "carrito.php",
                    type: "POST",
                    data: { producto_id: producto_id },
                    dataType: "json",
                    success: function(response){
                        if (response.success) {
                            actualizarCarrito();
                        } else {
                            alert("❌ Error: No se pudo añadir el producto.");
                        }
                    },
                    error: function() {
                        alert("❌ Error: No se pudo conectar con el servidor.");
                    }
                });
            });

            // Vaciar carrito
            $("#vaciar-carrito").click(function(){
                $.ajax({
                    url: "vaciar_carrito.php",
                    type: "POST",
                    success: function(){
                        actualizarCarrito();
                    }
                });
            });

            // Actualizar carrito
            function actualizarCarrito() {
                $.ajax({
                    url: "obtener_carrito.php",
                    type: "GET",
                    success: function(data){
                        $("#lista-carrito").html(data);
                    }
                });
            }

            actualizarCarrito(); // Cargar carrito al inicio
        });
    </script>

<?php else: ?>
    <h2>Bienvenido a Mi Web</h2>
    <p>Por favor, <a href="login.php">inicia sesión</a> o <a href="registro.php">regístrate</a>.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
