<?php
require_once '../config/config.php';

$db = new Database();
$con = $db->conectar();

// Asegúrate de obtener el id del producto desde la URL
$idProducto = isset($_GET['id']) ? $_GET['id'] : 0;

$sql = $con->prepare("SELECT idProductos, nombre, precio, descripcion FROM tablaproductos WHERE idProductos = ? AND activo = 1");
$sql->execute([$idProducto]);
$producto = $sql->fetch(PDO::FETCH_ASSOC);

// Verifica si el producto existe
if (!$producto) {
    die("Producto no encontrado");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre']; ?></title>
    <link href="../bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilosmain.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../bootstrap5/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <!-- Barra de navegación -->
    <?php include '../navegacion.php'; ?>

    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $imagen = "../productos/" . $idProducto . "/principal.jpg";
                    if (!file_exists($imagen)) {
                        $imagen = "../productos/nodisponible.jpg";
                    }
                    ?>
                    <img src="<?php echo $imagen; ?>" class="img-fluid" alt="<?php echo $producto['nombre']; ?>">
                </div>
                <div class="col-md-6">
                    <h2><?php echo $producto['nombre']; ?></h2>
                    <h5 class="text-primary">$<?php echo number_format($producto['precio'], 2, '.', ','); ?></h5>
                    <p><?php echo $producto['descripcion']; ?></p>
                    <button class="btn btn-success" onclick="addProducto(<?php echo $idProducto; ?>, '<?php echo hash_hmac('sha1', $idProducto, KEY_TOKEN); ?>')">Agregar al carrito</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        function addProducto(id, token) {
            let url = '../clases/carrito.php';
            let formData = new FormData();
            formData.append('id', id);
            formData.append('token', token);

            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    Swal.fire(
                        'Éxito',
                        'El producto se ha añadido al carrito',
                        'success'
                    );
                } else {
                    Swal.fire(
                        'Error',
                        'No hay suficientes existencias',
                        'error'
                    );
                }
            });
        }
    </script>

    <footer class="footer mt-5">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>Derechos reservados</h5>
                    <p>© 2024 Zapatería Adonay. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Enlaces Útiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Síguenos</h5>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
