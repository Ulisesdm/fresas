<?php
require '../config/config.php';
require '../clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {

  $nombres = trim($_POST['txtnom']);
  $apellidos = trim($_POST['txtape']);
  $email = trim($_POST['txtcor']);
  $telefono = trim($_POST['txttel']);
  $usuario = trim($_POST['txtus']);
  $password = trim($_POST['txtcon']);
  $repassword = trim($_POST['txtrecon']);

  if (esNulo([$nombres, $apellidos, $email, $telefono, $usuario, $password, $repassword])) {
    $errors[] = "Debe llenar todos los campos";
  }

  if (!esEmail($email)) {
    $errors[] = "La dirección no es válida";
  }

  if (!validaPassword($password, $repassword)) {
    $errors[] = "Las contraseñas no coinciden";
  }

  if (usuarioExiste($usuario, $con)) {
    $errors[] = "El nombre de usuario $usuario ya existe";
  }

  if (emailExiste($email, $con)) {
    $errors[] = "El correo $email ya existe";
  }

  if (count($errors) == 0) {

    $id = registrarCliente([$nombres, $apellidos, $email, $telefono], $con);

    if ($id > 0) {

      require '../clases/mailer.php';
      $mailer = new Mailer();
      $token = generarToken();
      $pass_hash = password_hash($password, PASSWORD_DEFAULT);
      $idusuario = registrarUsuario([$usuario, $pass_hash, $token, $id], $con);
      if ($idusuario > 0) {

        $url = SITE_URL . '/activar_cliente.php?id=' . $idusuario . '&token=' . $token;

        $asunto = "Activar cuenta para continuar - Inta MX";
        $cuerpo = "Estimado $nombres: <br> Para continuar con el proceso de registro, es necesario hacer click al siguiente link <a href='$url'>Activar cuenta</a>";

        if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
          header("Location: ../indexcorreoregistro.php");
          exit;
        }
      } else {
        $errors[] = "Error al registrar el usuario";
      }
    } else {
      $errors[] = "Error al registrar el cliente";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="../bootstrap5/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados CSS -->
  <link rel="shortcut icon" href="../img/kanye.ico">
  <link rel="stylesheet" href="../iniciar_sesion/estilos-carga-inicio.css">
  <link href="../bootstrap5/css/bootstrap.css" rel="stylesheet">
  <!-- JS AJAX -->
  <script src="../js/jquery-3.5.1/jquery.min.js"></script>
  <!-- CSS Y JS SWEET ALERT 2 -->
  <script src="../js/sweetalert2@11/sweetalert2.js"></script>
  <link href="../fontawesome/css/all.min.css" rel="stylesheet">
  <title>Registrar Usuario</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- Barra de navegación -->
  <?php include '../navegacion.php'; ?>

  <div class="fresas">
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
    <div class="fresa"></div>
  </div>

  <main class="d-flex align-items-center justify-content-center vh-100">
    <!-- Contenedor para centrar el formulario con el color rosa pastel -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6 p-4 form-container" id="barraNav">
          <h1 class="text-center text-primary mt-1"><strong>Crea una cuenta</strong></h1>

          <!-- Mostrar mensajes de error -->
          <?php mostrarMensajes($errors); ?>

          <!-- Formulario de registro -->
          <form action="registrar.php" id="frmRegistro" method="post" class="row mt-4">
            <div class="col-12 mb-3">
              <label for="txtcor" class="form-label fw-bold">Correo electrónico:</label>
              <input type="email" placeholder="alguien@example.com" name="txtcor" id="txtcor" class="form-control">
              <div class="invalid-feedback">Introduce un correo válido para continuar.</div>
              <span id="validaEmail" class="text-danger"></span>
            </div>
            <div class="col-12 col-md-6 mb-3">
              <label for="txtus" class="form-label fw-bold">Nombre de usuario:</label>
              <input type="text" placeholder="Tu nombre de usuario" name="txtus" id="txtus" class="form-control">
              <div class="invalid-feedback">Introduce un nombre de usuario.</div>
              <span id="validaUsuario" class="text-danger"></span>
            </div>
            <div class="col-12 col-md-6 mb-3">
              <label for="txtnom" class="form-label fw-bold">Nombre:</label>
              <input type="text" placeholder="Tu nombre real" name="txtnom" id="txtnom" class="form-control">
              <div class="invalid-feedback">Introduce al menos 4 caracteres.</div>
            </div>
            <div class="col-12 col-md-6 mb-3">
              <label for="txtape" class="form-label fw-bold">Apellido:</label>
              <input type="text" placeholder="Tu apellido" name="txtape" id="txtape" class="form-control">
              <div class="invalid-feedback">Introduce al menos 4 caracteres.</div>
            </div>
            <div class="col-12 col-md-6 mb-3">
              <label for="txttel" class="form-label fw-bold">Teléfono:</label>
              <input type="tel" placeholder="Tu número de teléfono" name="txttel" id="txttel" class="form-control">
            </div>
            <div class="col-12 col-md-6 mb-3">
              <label for="txtcon" class="form-label fw-bold">Crea una contraseña:</label>
              <input type="password" placeholder="********" name="txtcon" id="txtcon" class="form-control">
              <div class="invalid-feedback">Debe tener al menos 8 caracteres.</div>
            </div>
            <div class="col-12 col-md-6 mb-3">
              <label for="txtrecon" class="form-label fw-bold">Repite la contraseña:</label>
              <input type="password" placeholder="********" name="txtrecon" id="txtrecon" class="form-control">
              <div class="invalid-feedback">Las contraseñas deben coincidir.</div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mb-1">
              <input type="submit" id="btnGuaAut" class="btn btn-primary" value="Registrar">
              <div class="invalid-feedback">Asegúrate de llenar todos los campos.</div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <footer class="text-center text-primary fixed-bottom mt-5">
    <div class="text-center p-3" id="barraNav">
      © 2024 Copyright:
      <a class="text-primary">Derechos reservados | Las Fresas de Sor Juana</a>
    </div>
  </footer>


  <!-- Bootstrap Java -->
  <script src="../bootstrap5/js/bootstrap.bundle.js"></script>

  <script>
    let txtUsuario = document.getElementById('txtus')
    txtUsuario.addEventListener("blur", function() {
      existeUsuario(txtUsuario.value)
    }, false)

    let txtEmail = document.getElementById('txtcor')
    txtEmail.addEventListener("blur", function() {
      existeEmail(txtEmail.value)
    }, false)

    function existeEmail(email) {
      let url = "../clases/clienteAjax.php"
      let formData = new FormData()
      formData.append("action", "existeEmail")
      formData.append("txtcor", email)

      fetch(url, {
          method: 'POST',
          body: formData
        }).then(response => response.json())
        .then(data => {

          if (data.ok) {
            document.getElementById('txtcor').value = ''
            document.getElementById('validaEmail').innerHTML = 'El correo electrónico no está disponible'
          } else {
            document.getElementById('validaEmail').innerHTML = ''
          }

        })
    }

    function existeUsuario(usuario) {

      let url = "../clases/clienteAjax.php"
      let formData = new FormData()
      formData.append("action", "existeUsuario")
      formData.append("txtus", usuario)

      fetch(url, {
          method: 'POST',
          body: formData
        }).then(response => response.json())
        .then(data => {

          if (data.ok) {
            document.getElementById('txtus').value = ''
            document.getElementById('validaUsuario').innerHTML = 'Usuario no disponible'
          } else {
            document.getElementById('validaUsuario').innerHTML = ''
          }

        })
    }
  </script>

</body>

</html>