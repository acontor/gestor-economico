<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gestor de gastos - Nuevo gasto</title>
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
        <li class="nav-item active">
          <a class="nav-link" href="gasto.php">
            <i class="fas fa-file-export"></i>
            <span>Nuevo gasto</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Otros
        </div>
        <li class="nav-item">
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
                <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
              <h1 class="h3 mb-0 text-gray-800">Nuevo gasto</h1>
            </div>
            <div class="container-fluid">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-warning">Datos del gasto</h6>
                </div>
                <div class="card-body">
                  <div class="container">
                    <div class="card-body">
                      <form action="utils/insertar.php" method="POST">
                        <input type="text" class="d-none" name="tipo" value="Gastos">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputName">Fecha</label>
                            <input type="date" class="form-control" name="fecha">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputCompany">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" placeholder="€">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputMessage">Descripción</label>
                          <textarea class="form-control" rows="1" name="descripcion"></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning">Guardar</button>
                        <?php
                        if (isset($_GET['msg'])) {
                          echo $_GET['msg'];
                        }
                        ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="src/js/jquery.min.js"></script>
      <script src="src/js/bootstrap.bundle.min.js"></script>

      <!-- Page level plugins -->
      <script src="src/js/jquery.dataTables.min.js"></script>
      <script src="src/js/dataTables.bootstrap4.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="src/js/script.js"></script>
      <script src="src/js/tables.js"></script>
      <script src="src/js/fontawesome.js"></script>
    <?php
  }
    ?>

</body>

</html>