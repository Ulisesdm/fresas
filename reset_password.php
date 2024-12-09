<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clienteFunciones.php';

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if ($user_id == '' || $token == '') {
  header("Location: index.php");
  exit;
}

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!verificarTokenRequest($user_id, $token, $con)) {
  header("Location: index.php");
  exit;
}

if (!empty($_POST)) {

  $password = trim($_POST['password']);
  $repassword = trim($_POST['repassword']);

  if (esNulo([$user_id, $token, $password, $repassword])) {
    $errors[] = "Debe llenar todos los campos";
  }

  if (!validaPassword($password, $repassword)) {
    $errors[] = "Las contraseñas no coinciden";
  }

  if (count($errors) == 0) {
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    if (actualizarPassword($user_id, $pass_hash, $con)) {
      header("Location: iniciar_sesion/iniciarSesion.php");
      exit;
    } else {
      $errors[] = "Error al modificar contraseña";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Las Fresas de Sor Juana</title>
  <!-- ESTILOS PERSONALIZADOS CSS -->
  <link rel="stylesheet" href="css/estilos-glass.css">
  <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap5/css/bootstrap.css" rel="stylesheet">
  <link href="fontawesome/css/all.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap Java -->
  <script src="jquery/jquery-3.5.1.min.js"></script>
  <script src="bootstrap5/js/bootstrap.bundle.js"></script>
  <link rel="stylesheet" href="css/estilosmain.css">
</head>

<body>

  <!-- Barra de navegacion -->
  <nav class="navbar navbar-expand-lg bg-primary fixed-top">
    <div class="container-fluid">
      <img src="img/icon.png" alt="" width="40" height="40" class="d-inline-block align-text-top">
      <a class="navbar-brand" href="../carrito/catalogo.php">&nbsp Las Fresas de Sor Juana</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active mx-2" aria-current="page" href="carrito/catalogo.php">Ver todos los productos</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ver por categorías
            </a>

            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
              <li><a class="dropdown-item" href="carrito/catalogoadidas.php">Fresas con crema</a></li>
              <li><a class="dropdown-item" href="carrito/catalogonike.php">Fresas sin crema</a></li>
              <li><a class="dropdown-item" href="carrito/catalogovans.php">Fresas Estilo Jalisco</a></li>
              <li><a class="dropdown-item" href="carrito/catalogoconverse.php">Converse</a></li>
            </ul>

          </li>

          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="quienesSomos.php">Quiénes sómos</a>
          </li>

        </ul>
      </div>
      <?php if (isset($_SESSION['user_id'])) { ?>

        <div class="d-flex d-sm-none d-lg-block">

          <li class="btn btn-primary nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user-group" style="color: #ffffff;"></i> <?php echo $_SESSION['user_name']; ?></a>

            <ul class="dropdown-menu dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
              <li><a class="dropdown-item" href="carrito/compras.php"><i class="fa-solid fa-dollar-sign fa-beat"></i> Mis compras</a></li>
              <li><a class="dropdown-item" href="cerrar.php"><i class="fa-solid fa-xmark fa-beat"></i> Cerrar Sesión</a></li>
            </ul>

          </li>
        </div>

      <?php } else { ?>


        <div class="d-flex d-sm-none d-lg-block">
          <a class="btn btn-primary mx-2" href="iniciar_sesion/iniciarSesion.php"><i class="fa-solid fa-user fa-beat" style="color: #f7f7f7;"></i> Ingresar</a>
        </div>
      <?php } ?>

      <div class="d-flex d-sm-none d-lg-block">
        <a class="btn btn-primary mx-2" href="carrito/checkout.php"><i class="fa-solid fa-cart-shopping fa-beat" style="color: #ffffff;"></i> Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart ?></span></a>
      </div>


    </div>
  </nav>


  <main>
    <div class="container">
      <div class="container mt-3 mt-lg-3 mt-md-3 mt-xl-3 mt-xxl-6">
        <div class="row align-items-center">
          <div class="col-sm-12 d-none col-lg-6 mb-4 p-1 rounded d-sm-none d-md-none d-lg-block mt-4 mt-md-0" id="">

            <h2 class="text-center text-dark">¡Casi terminamos, estás a un paso!</h2>
            <img src="img/fresatype.png" class="rounded mx-auto d-block d-sm-none d-md-block" width="410" alt="...">
          </div>

          <!-- Apartado Derecho -->
          <div class="col-sm-12 col-lg-6 mt-4 p-3 rounded" id="barraNav">
            <h1 class="text-center text-primary mt-3"><strong> Nueva Contraseña </strong></h1>

            <form action="reset_password.php" method="POST" class="row mt-5" autocomplete="off">
              <?php mostrarMensajes($errors) ?>
              <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>" />
              <input type="hidden" name="token" id="token" value="<?= $token; ?>" />

              <div class="col-12 col-md-12 mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" placeholder="Introduce una nueva contraseña para iniciar sesión" name="password" id="password" class="form-control" required>
              </div>

              <div class="col-12 col-md-12 mb-3">
                <label for="repassword" class="form-label">Confirmar contraseña:</label>
                <input type="password" placeholder="Confirma la nueva contraseña" name="repassword" id="repassword" class="form-control" required>
              </div>

              <div class="text-center text-primary mt-3">
                <a href="iniciar_sesion/iniciarSesion.php" class="d-inline-block">¿Ya tienes cuenta? Inicia Sesión</a>
              </div>

              <div class="d-grid gap-2 col-6 mx-auto mb-4"><br>
                <input type="submit" class="btn btn-primary" value="Continuar">
                <div class="invalid-feedback"> Asegúrate de que todos los campos estén llenos</div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </main>


  <!-- Pie de pagina -->
  <footer class="text-center text-primary fixed-bottom mt-5">
    <div class="text-center p-1 p-lg-3 p-sm-3 p-md-3 p-xl-3 p-xxl-3" id="barraNav">
      © 2024 Copyright:
      <a class="text-primary" href="#">Derechos reservados</a>
    </div>
  </footer>
  <!-- Bootstrap Java -->
  <script src="../bootstrap5/js/bootstrap.bundle.js"></script>

</body>

</html>