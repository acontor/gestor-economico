<!DOCTYPE html>
<html>

<head>
  <title>Gestor de gastos</title>
  <link rel="stylesheet" type="text/css" href="src/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="src/css/login.css">
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION['username'])) {
    header('Location: informes.php');
  } else {
  ?>
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="user_card">
          <div class="d-flex justify-content-center">
            <div class="brand_logo_container">
              <img src="src/img/logo.png" class="brand_logo" alt="Logo">
            </div>
          </div>
          <div class="d-flex justify-content-center form_container">
            <form action="utils/log_in.php" method="POST">
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="username" class="form-control input_user" value="" placeholder="Nombre de usuario">
              </div>
              <div class="input-group mb-2">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="password" class="form-control input_pass" value="" placeholder="Contraseña">
              </div>
              <?php
              if (isset($_GET['msg'])) {
                echo $_GET['msg'];
              }
              ?>
              <div class="d-flex justify-content-center mt-3 login_container">
                <button type="submit" name="button" class="btn login_btn">Iniciar sesión</button>
              </div>
            </form>
          </div>
          <div class="mt-4">
            <div class="d-flex justify-content-center links">
              ¿Aún no tienes cuenta? <a href="sign_up.php" class="ml-2">Regístrate</a>
            </div>
            <div class="d-flex justify-content-center links">
              <small>Cuenta: alvaro | Contraseña: Ab_12345</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="src/js/fontawesome.js"></script>
  <?php
  }
  ?>
</body>

</html>