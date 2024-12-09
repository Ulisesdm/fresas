<?php

require_once 'config/config.php';

$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT idProductos, nombre, precio FROM tablaproductos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ESTILOS PERSONALIZADOS CSS -->
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap5/css/bootstrap.css" rel="stylesheet">
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Zapatería Adonay</title>
    <!-- Bootstrap Java -->
    <script src="jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="css/estilosmain.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            <div class="row justify-content-center">
                <div class="col-sm-12 col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 mt-1">
                            <div id="carouselExampleControls" class="carousel slide" data-interval="corusel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a href="catalogoadidas.php">
                                            <img src="img/banner.png" class="d-block w-100" alt="...">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="catalogovans.php">
                                            <img src="img/Publicidad2.jpg" href="" class="d-block w-100" alt="...">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="catalogoconverse.php">
                                            <img src="img/Publicidad6.jpg" href="" class="d-block w-100" alt="...">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="catalogonike.php">
                                            <img src="img/Publicidad3.jpg" href="" class="d-block w-100" alt="...">
                                        </a>
                                    </div>

                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Atrás</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Siguiente</span>
                                </button>
                            </div><br>
                        </div>
                    </div>

                </div>
                <h5 class="text-center text-dark col-lg-8 mt-3">Bienvenido a Las Fresas de Sor Juana. Aquí encontrarás las mejores fresas
                    con crema de Toluca a muy buen precio. Haz la prueba a partir de hoy.</h5><br>
            </div>

            <div class="container">
                <div class="row align-items-center">
                    <div class="row row-cols-1 row-cols-lg-3 g-3">

                        <div class="col">
                            <div class="card text-white bg-primary mb-3">
                                <img src="img/fresa1.png" class="card-img-top w-35" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Strawberry Heat Pack</h5>
                                    <p class="card-text">Prueba la nueva combinación de fresas con crema y almendras.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card text-white bg-primary mb-3">
                                <img src="img/fresa2.jpg" class="card-img-top w-35" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Nuevos productos en stock</h5>
                                    <p class="card-text">Compra con nosotros y prueba nuestro nuevo Strawberry Cream Rush.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card text-white bg-primary mb-3">
                                <img src="img/fresa3.jpg" class="card-img-top w-35" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Prueba las nuevas combinaciones</h5>
                                    <p class="card-text">Ya disponible para su compra en las Fresas de Sor Juana.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><br>

            <!-- ultimo nivel -->
            <div class="mt-2 ">
                <h1 class="text-center text-dark">- - - - Precio y calidad - - - -</h1>
            </div>

            <div class="container mt-5 col-sm-12 mb-4">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-lg-5 my-auto">
                        <h2 class=" text-center text-dark">¡Vísitanos en nuestra tienda!</h2> <br>
                        <p class="text-center text-dark">Si has comprado en línea puedes venir a la tienda de 9:00 AM a 18:00 PM a recoger tu pedido.<br>
                    </div>
                    <div class="col-sm-12 col-lg-5">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3657.999274266029!2d-99.6538276!3d19.287761!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd89cf987e9223%3A0x2912c330ae10292c!2sSerendipia%20Beauty%20Room!5e1!3m2!1ses!2smx!4v1731364097768!5m2!1ses!2smx" width="600" height="330" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cards = document.querySelectorAll(".card");

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => observer.observe(card));
        });
    </script>

    <footer class="footer mt-5">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>Derechos reservados</h5>
                    <p>© 2024 Las Fresas de Sor Juana. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Enlaces</h5>
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