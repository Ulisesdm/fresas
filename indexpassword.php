<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/kanye.ico">
    <link rel="stylesheet" href="iniciar_sesion/estilos-carga-inicio.css">
    <link href="bootstrap5/css/bootstrap.css" rel="stylesheet">
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <script src="js/jquery-3.5.1/jquery.min.js"></script>
    <script src="js/sweetalert2@11/sweetalert2.js"></script>
    <title>Las Fresas de Sor Juana</title>
    <link href="css/password.css" rel="stylesheet">
</head>

<body>

<div class="fresas">
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
  </div>
  
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

    <main class="fixed-top-spacing">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-6 main-container">
                    <h1 class="text-center">¡Se ha actualizado tu contraseña!</h1>
                    <div class="row justify-content-center">
                        <div class="col-12 mt-3">
                            <div class="card card-custom">
                                <div class="card-body"><br>
                                    <img src="img/password.gif" class="card-img-top mx-auto d-block img-fluid" alt="Password Updated"><br>
                                    <a href="iniciar_sesion/iniciarSesion.php">Puedes iniciar sesión haciendo click aquí</a>
                                </div>
                            </div>
                        </div>
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

    <script src="jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.bundle.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/funciones.js"></script>
</body>

</html>