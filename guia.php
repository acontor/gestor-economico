<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gestor de gastos - Guía de uso</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="src/css/cuentas.css" rel="stylesheet">

</head>

<body id="page-top" class="sidebar-toggled">
  <?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: index.php');
  } else {
  ?>
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="informes.php">
          <div class="sidebar-brand-icon rotate-n-15">
            <img src="src/img/logo.png" class="img-fluid mt-3" alt="Logo">
          </div>
          <div class="sidebar-brand-text mx-3">Gestor</div>
        </a>
        <hr class="sidebar-divider my-0 mt-4">
        <li class="nav-item">
          <a class="nav-link" href="informes.php">
            <i class="fas fa-table"></i>
            <span>Informes</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Acciones
        </div>
        <li class="nav-item">
          <a class="nav-link" href="ingreso.php">
            <i class="fas fa-file-import"></i>
            <span>Nuevo ingreso</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gasto.php">
            <i class="fas fa-file-export"></i>
            <span>Nuevo gasto</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Otros
        </div>
        <li class="nav-item active">
          <a class="nav-link" href="guia.php">
            <i class="fab fa-glide-g"></i>
            <span>Guía de uso</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="https://github.com/acontor" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fab fa-github fa-sm fa-fw mr-2 text-gray-400"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="userDropdown">
                  <span class="mr-2 d-lg-inline text-gray-600 small"><?= $_SESSION["username"]; ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="utils/log_out.php" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                </a>
              </li>
            </ul>
          </nav>
          <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Guía de uso</h1>
            </div>
            <div class="container-fluid">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-warning">Pestaña de informes mensuales</h6>
                </div>
                <div class="card-body">
                  <h3>Vista previa</h3>
                  <p>La siguiente imagen muestra una vista previa de la pestaña informes. Aquí aparecerán los informes mensuales que hayamos creado.</p>
                  <small>* Recuerda que para crear un informe, lo único que tenemos que hacer es crear un gasto o ingreso del mes que queramos gestionar.</small>
                  <img src="src/img/informes.png" class="img-fluid" />
                  <h3 class="mt-4">Características</h3>
                  <p>Podemos observar que, en la tabla, se muestra la fecha de nuestros movimientos recogidos en meses, el balance del mes y los gastos e ingresos totales del mes.</p>
                  <p>También encontramos un botón dispuesto para poder generar un PDF con los movimientos detallados del mes que selecionemos.</p>
                  <p>Podemos ver que la pestaña informes nos permite seleccionar el número de informes mensuales a mostrar, filtrar introduciendo un dato que buscará a lo largo de todas las columnas de la tabla y ordenar las columnas por fecha, balance, gastos e ingresos</p>
                </div>
              </div>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Informes detallados</h6>
                </div>
                <div class="card-body">
                  <h3>Generar informe</h3>
                  <p>Para generar un informe, nos dirigimos a la pestaña de Informes y seleccionamos el botón de generar que vemos a continuación.</p>
                  <img src="src/img/generar.png" class="img-fluid" />
                  <p class="mt-4">Esto nos generará una vista como la que podemos ver a continuación:</p>
                  <img src="src/img/informe.png" class="img-fluid" />
                  <h3 class="mt-4">Descargar informe</h3>
                  <p>Una vez hemos generado el informe, nos proporciona un botón en la parte superior que nos permite descargar el informe o imprimirlo directamente.</p>
                  <p>Si seleccionamos el botón de descargar, nos aparecerá el explorador de ventanas para guardar el PDF dónde queramos.</p>
                </div>
              </div>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Crear nuevo ingreso</h6>
                </div>
                <div class="card-body">
                  <h3>Vista previa</h3>
                  <p>La siguiente imagen muestra una vista previa de la pestaña Nuevo Ingreso. Veremos un formulario para guardar los ingresos que necesitemos.</p>
                  <small>* Recuerda que para crear un informe, lo único que tenemos que hacer es crear un gasto o ingreso del mes que queramos gestionar.</small>
                  <img src="src/img/ingreso.png" class="img-fluid" />
                  <h3 class="mt-4">Crear ingreso</h3>
                  <p>Para crear un ingreso, seleccionamos la fecha de dicho ingreso, la cantidad y una breve descripción orientativa.</p>
                  <p>Si el ingreso que vamos a realizar es de un mes que aún no estuviese creado, éste informe mensual se crearía automáticamente al guardar el primer ingreso o gasto.</p>
                  <p>Una vez tengamos todo relleno y seleccionemos el botón Guardar, el ingreso será almacenado en una base de datos para su posterior manipulación.</p>
                </div>
              </div>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Crear nuevo gasto</h6>
                </div>
                <div class="card-body">
                  <h3>Vista previa</h3>
                  <p>La siguiente imagen muestra una vista previa de la pestaña Nuevo Gasto. Veremos un formulario para guardar los gastos que necesitemos.</p>
                  <small>* Recuerda que para crear un informe, lo único que tenemos que hacer es crear un gasto o ingreso del mes que queramos gestionar.</small>
                  <img src="src/img/gasto.png" class="img-fluid" />
                  <h3 class="mt-4">Crear gasto</h3>
                  <p>Para crear un gasto, seleccionamos la fecha de dicho gasto, la cantidad y una breve descripción orientativa.</p>
                  <p>Si el gasto que vamos a realizar es de un mes que aún no estuviese creado, éste informe mensual se crearía automáticamente al guardar el primer gasto o ingreso.</p>
                  <p>Una vez tengamos todo relleno y seleccionemos el botón Guardar, el gasto será almacenado en una base de datos para su posterior manipulación.</p>
                </div>
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
