<?php
require_once '../config/config.php';
require_once '../clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();
$errors = [];

if (!empty($_POST)) {


  $email = trim($_POST['txtcor']);

  if (esNulo([$email])) {
    $errors[] = "Debe llenar todos los campos";
  }

  if (!esEmail($email)) {
    $errors[] = "La direccion no es válida";
  }

  if (count($errors) == 0) {
    if (emailExiste($email, $con)) {
      $sql = $con->prepare("SELECT datos_usuarios.idusuario, tablaclientes.nombres FROM datos_usuarios INNER JOIN tablaclientes ON datos_usuarios.id_cliente=tablaclientes.idclientes WHERE tablaclientes.email LIKE ? LIMIT 1");
      $sql->execute([$email]);
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $user_id = $row['idusuario'];
      $nombres = $row['nombres'];

      $token = solicitarPassword($user_id, $con);

      if ($token !== null) {
        require  '../clases/mailer.php';
        $mailer = new Mailer();
        $url = SITE_URL . '/reset_password.php?id=' . $user_id . '&token=' . $token;

        $asunto = "Recuperar cuenta - Las Fresas de Sor Juana";
        $cuerpo = "Estimado $nombres: <br> Si haz solicitado un cambio de contraseña da clic en el siguiente link <a href='$url'>$url</a>.";
        $cuerpo .= "<br>Si no hiciste esa solicitud puedes ignorar este correo.";
        if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
          header("Location: ../indexcorreo.php");
          exit;
        }
      }
    } else {
      $errors[] = "No existe una cuenta asociada a este correo";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="../bootstrap5/css/bootstrap.min.css" rel="stylesheet">
  <!-- ESTILOS PERSONALIZADOS CSS -->
  <link rel="shortcut icon" href="../img/kanye.ico">
  <link rel="stylesheet" href="../iniciar_sesion/estilos-carga-inicio.css">
  <link href="login.css" rel="stylesheet">
  <link href="../bootstrap5/css/bootstrap.css" rel="stylesheet">
  <!-- JS AJAX -->
  <script src="../js/jquery-3.5.1/jquery.min.js"></script>
  <!-- CSS Y JS SWEET ALERT 2 -->
  <script src="../js/sweetalert2@11/sweetalert2.js"></script>
  <link href="../fontawesome/css/all.min.css" rel="stylesheet">
  <title>Las Fresas de Sor Juana</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

  <!-- Barra de navegacion -->

  <div class="fresas">
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
  </div>

  <nav class="navbar navbar-expand-lg bg-primary fixed-top">
    <div class="container-fluid">
      <img src="../img/icon.png" alt="" width="40" height="40" class="d-inline-block align-text-top">
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
              <li><a class="dropdown-item" href="../carrito/compras.php"><i class="fa-solid fa-dollar-sign fa-beat"></i> Mis compras</a></li>
              <li><a class="dropdown-item" href="../cerrar.php"><i class="fa-solid fa-xmark fa-beat"></i> Cerrar Sesión</a></li>
            </ul>

          </li>
        </div>

      <?php } else { ?>


        <div class="d-flex d-sm-none d-lg-block">
          <a class="btn btn-primary mx-2" href="../iniciar_sesion/iniciarSesion.php"><i class="fa-solid fa-user fa-beat" style="color: #f7f7f7;"></i> Ingresar</a>
        </div>
      <?php } ?>

      <div class="d-flex d-sm-none d-lg-block">
        <a class="btn btn-primary mx-2" href="../carrito/checkout.php"><i class="fa-solid fa-cart-shopping fa-beat" style="color: #ffffff;"></i> Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart ?></span></a>
      </div>


    </div>
  </nav>

  <main>
    <div class="login-container">
      <h1>Recuperar Contraseña</h1>

      <?php mostrarMensajes($errors); ?>

      <form action="recuperar.php" method="POST" autocomplete="off">
        <div class="input-group">
          <label for="txtcor">Correo electrónico</label>
          <input type="email" id="txtcor" name="txtcor" placeholder="Introduce el correo electrónico" required>
          <div class="invalid-feedback">Por favor introduce el correo electrónico correctamente</div>
        </div>
        <!-- Enlace de registro centrado -->
        <div class="text-center mt-3">
          <a href="../registrar/registrar.php" class="d-inline-block">¿No tienes cuenta?</a>
        </div>
        <br><button type="submit" class="btn-submit">Continuar</button>
      </form>
    </div>

  </main>

  <!-- Pie de pagina -->
  <footer>
    <p>© 2024 - Las Fresas de Sor Juana | Todos los derechos reservados</p>
  </footer>
  <!-- Bootstrap Java -->
  <script src="../bootstrap5/js/bootstrap.bundle.js"></script>

</body>

</html>