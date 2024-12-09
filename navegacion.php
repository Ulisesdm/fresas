<?php
$current_page = basename($_SERVER['PHP_SELF']); // Obtiene el nombre del archivo actual
?>

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
          <a class="nav-link active mx-2" aria-current="page" href="../carrito/catalogo.php">Ver todos los productos</a>
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
          <a class="nav-link mx-2 active" aria-current="page" href="../quienesSomos.php">Quiénes sómos</a>
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
    <?php } else { // Si no estás logueado 
    ?>

      <!-- Aquí ajustamos el comportamiento del botón dependiendo de la página -->
      <div class="d-flex d-sm-none d-lg-block">
        <?php if ($current_page == 'registrar.php') { ?>
          <!-- Si estamos en registrar.php, mostramos un botón para redirigir a iniciar sesión -->
          <a class="btn btn-primary mx-2" href="../iniciar_sesion/iniciarSesion.php">
            <i class="fa-solid fa-user fa-beat" style="color: #f7f7f7;"></i> Iniciar Sesión
          </a>
        <?php } else { ?>
          <!-- Si no estamos en registrar.php, mostramos un botón para redirigir a registrar -->
          <a class="btn btn-primary mx-2" href="../registrar/registrar.php">
            <i class="fa-solid fa-user-plus fa-beat" style="color: #f7f7f7;"></i> Registrar
          </a>
        <?php } ?>
      </div>

    <?php } ?>

    <div class="d-flex d-sm-none d-lg-block">
      <a class="btn btn-primary mx-2" href="../carrito/checkout.php">
        <i class="fa-solid fa-cart-shopping fa-beat" style="color: #ffffff;"></i> Carrito
        <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
      </a>
    </div>
  </div>
</nav>