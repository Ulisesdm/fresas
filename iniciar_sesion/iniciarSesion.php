<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();
$errors = [];

$proceso = isset($_GET['pago']) ? 'pago' : 'login';

if (!empty($_POST)) {

  $usuario = trim($_POST['txtus']);
  $password = trim($_POST['txtcon']);
  $proceso = $_POST['proceso'] ?? 'login';

  if (esNulo([$usuario, $password])) {
    $errors[] = "Debe llenar todos los campos";
  }

  if (count($errors) == 0) {
    $errors[] = login($usuario, $password, $con, $proceso);
  }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Fresas con Crema</title>
  <link href="../bootstrap5/css/bootstrap.min.css" rel="stylesheet">
  <link href="../fontawesome/css/all.min.css" rel="stylesheet">
  <link href="../fontawesome/css/all.min.css" rel="stylesheet">
  <link href="login.css" rel="stylesheet">
</head>

<!-- Barra de navegacion -->
<?php include '../navegacion.php'; ?>

<body>
  <!-- Fondo animado de fresas -->
  <div class="fresas">
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
  </div>

  <!-- Contenedor del formulario de login -->
  <div class="login-container">
    <h1>Iniciar Sesión</h1>

    <?php mostrarMensajes($errors); ?>

    <form method="POST">
      <div class="input-group">
        <label for="txtus">Nombre de usuario</label>
        <input type="text" id="txtus" name="txtus" placeholder="Introduce tu nombre de usuario" required>
      </div>
      <div class="input-group">
        <label for="txtcon">Contraseña</label>
        <input type="password" id="txtcon" name="txtcon" placeholder="Introduce tu contraseña" required>
      </div>
      <!-- Enlace de "Olvidaste tu contraseña" centrado -->
      <div class="text-center mt-3">
        <a href="recuperar.php" class="d-inline-block">¿Olvidaste tu contraseña?</a>
      </div>
      <br><button type="submit" class="btn-submit">Iniciar sesión</button>
    </form>
  </div>


  <!-- Pie de página -->
  <footer>
    <p>© 2024 - Las Fresas de Sor Juana | Todos los derechos reservados</p>
  </footer>

  <script src="../bootstrap5/js/bootstrap.bundle.js"></script>
</body>

</html>