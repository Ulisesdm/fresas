<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
  <!-- ESTILOS PERSONALIZADOS CSS -->
  <link rel="shortcut icon" href="img/kanye.ico">
  <link rel="stylesheet" href="iniciar_sesion/estilos-carga-inicio.css">
  <link rel="stylesheet" href="css/estilos-glass.css">
  <link href="bootstrap5/css/bootstrap.css" rel="stylesheet">
  <link href="fontawesome/css/all.min.css" rel="stylesheet">
  <!-- JS AJAX -->
  <script src="js/jquery-3.5.1/jquery.min.js"></script>
  <!-- CSS Y JS SWEET ALERT 2 -->
  <script src="js/sweetalert2@11/sweetalert2.js"></script>

  <title>Las Fresas de Sor Juana</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
        <a class="btn btn-primary mx-2" href="Registrar/Registrar.php"><i class="fa-solid fa-user-plus fa-beat" style="color: #f7f7f7;"></i> Regístrate</a>
      </div>


    </div>
  </nav>


  <!-- Primer nivel -->
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-sm-12 col-lg-8"> <!-- Adjust the column size to control the width of the card -->
        <h1 class="mt-5 text-dark text-center">TE HEMOS ENVIADO UN CORREO</h1>
        <div class="row justify-content-center">
          <div class="col-sm-12 col-lg-8 mt-3"> <!-- Adjust the column size to control the width of the card -->
            <div class="card">
              <img src="img/email.gif" alt="..." height="200" class="card-img-top mx-auto d-block img-fluid">
              <div class="card-body">
                <p class="text-center text-primary">Revisa tu bandeja de entrada para restablecer tu contraseña.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><br>

  <!-- Pie de pagina -->
  <footer class="text-center text-primary fixed-bottom mt-5">
    <div class="text-center p-3">
      © 2024 Copyright:
      <a class="text-primary" href="#">Derechos reservados</a>
    </div>
  </footer>

  <script src="jquery/jquery-3.5.1.min.js"></script>
  <script src="bootstrap5/js/bootstrap.bundle.js"></script>
  <script src="js/datatables.min.js"></script>
  <script src="js/funciones.js"></script>

</body>

</html>