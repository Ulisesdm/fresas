<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/adminFunciones.php';

$db = new Database();
$con = $db->conectar();
$errors = [];

//$password = password_hash('admin', PASSWORD_DEFAULT);
//$sql = "INSERT INTO admin (usuario, password, nombre, email, activo, fecha_alta)
//VALUES ('admin','$password','Administrador','mich3000mich@gmail.com','1',NOW())";
//$con->query($sql);

if (!empty($_POST)) {
  $usuario = trim($_POST['usuario']);
  $password = trim($_POST['password']);

  if (esNulo([$usuario, $password])) {
    $errors[] = "Debe llenar todos los campos";
  }
  if (count($errors) == 0) {
    $errors[] = login($usuario, $password, $con);
  }
}


?>
<style>
  /* General */
  body {
    margin: 0;
    padding: 0;
    background-color: #fff;
    font-family: 'Arial', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
  }

  /* Contenedor general del login */
  .login-container {
    position: relative;
    width: 100%;
    max-width: 500px;
    padding: 40px;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 10;
  }

  /* Título */
  .login-container h1 {
    font-size: 30px;
    color: #d83131;
    /* Color similar a fresas */
    text-align: center;
    margin-bottom: 20px;
  }

  /* Campos del formulario */
  .input-group {
    margin-bottom: 15px;
  }

  .input-group label {
    font-weight: bold;
    color: #333;
  }

  .input-group input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #f9f9f9;
  }

  /* Botón de enviar */
  .btn-submit {
    width: 100%;
    padding: 12px;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-submit:hover {
    background-color: #c0392b;
  }

  /* Fresas animadas */
  .fresas {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
  }

  .fresa {
    width: 200px;
    height: 200px;
    background-size: cover;
    background-position: center;
    position: absolute;
    animation: moverFresa 6s ease-in-out infinite;
  }

  .fresa:nth-child(1) {
    left: 5%;
    background-image: url('../img/fresa.gif');
    animation-duration: 8s;
    animation-delay: 0s;
  }

  .fresa:nth-child(2) {
    left: 25%;
    background-image: url('../img/fresa.gif');
    animation-duration: 6s;
    animation-delay: 2s;
  }

  .fresa:nth-child(3) {
    left: 50%;
    background-image: url('../img/fresa.gif');
    animation-duration: 7s;
    animation-delay: 1s;
  }

  .fresa:nth-child(4) {
    left: 75%;
    background-image: url('../img/fresa.gif');
    animation-duration: 6s;
    animation-delay: 1s;
  }

  /* Animación para el movimiento de fresas */
  @keyframes moverFresa {
    0% {
      transform: translateY(0);
      opacity: 1;
    }

    50% {
      transform: translateY(600px);
      opacity: 0.8;
    }

    100% {
      transform: translateY(0);
      opacity: 1;
    }
  }

  /* Footer */
  footer {
    position: absolute;
    bottom: 10px;
    width: 100%;
    text-align: center;
    color: #333;
    font-size: 14px;
  }

  main {
    background-color: #f8d7da;
    /* Rosa pastel */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
</style>

<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <!-- ESTILOS PERSONALIZADOS CSS -->
    <link rel="shortcut icon" href="../img/kanye.ico">
    <link rel="stylesheet" href="../iniciar_sesion/estilos-carga-inicio.css">
    <!-- <link rel="stylesheet" href="css/estilos-glass.css"> -->
    <link href="../bootstrap5/css/bootstrap.css" rel="stylesheet">
    <!-- JS AJAX -->
    <script src="../js/jquery-3.5.1/jquery.min.js"></script>
    <!-- CSS Y JS SWEET ALERT 2 -->
    <script src="../js/sweetalert2@11/sweetalert2.js"></script>
    <link href="../fontawesome/css/all.min.css" rel="stylesheet">
    <title>Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>

  <div class="fresas">
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
  </div>

  <!-- Barra de navegacion -->
  <nav class="navbar navbar-expand-lg navbar-primary fixed-top">
    <div class="container-fluid">
      <img src="../img/icon.png" alt="" width="55" height="40" class="d-inline-block align-text-top">
      <a class="navbar-brand" href="#">Admin</a>
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
              <li><a class="dropdown-item" href="../carrito/catalogoadidas.php">Matemáticas</a></li>
              <li><a class="dropdown-item" href="../carrito/catalogonike.php">Música</a></li>
              <li><a class="dropdown-item" href="../carrito/catalogoskechers.php">Pintura</a></li>
              <li><a class="dropdown-item" href="../carrito/catalogovans.php">Español</a></li>
            </ul>

          </li>

        </ul>
      </div>

    </div>
  </nav>

  <div class="login-container">
    <h1>Iniciar sesión</h1>
    <form method="POST">
      <div class="input-group">
        <label for="txtus">Nombre de usuario</label>
        <input type="text" id="usuario" name="usuario" placeholder="Introduce tu nombre de usuario" required>
      </div>
      <div class="input-group">
        <label for="txtcon">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required>
      </div>
      <button type="submit" class="btn-submit">Iniciar sesión</button>
    </form>
  </div>


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