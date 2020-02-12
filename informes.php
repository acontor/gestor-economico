<?php
require_once('utils/connect_db.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gestor de gastos - Informes</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="src/css/cuentas.css" rel="stylesheet">
  <link href="src/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
        <li class="nav-item active">
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
          <!-- End of Topbar -->
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Informes</h1>
            </div>
            <div class="container-fluid">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-warning">Tabla de informes</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Balance</th>
                          <th>Ingresos</th>
                          <th>Gastos</th>
                          <th class="text-center">Generar</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Fecha</th>
                          <th>Balance</th>
                          <th>Ingresos</th>
                          <th>Gastos</th>
                          <th class="text-center">Generar</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php
                        $informes = selectInformes($dbh);
                        for ($i = 0; $i < sizeof($informes); $i++) { ?>
                          <tr>
                            <?php
                            $fecha = $informes[$i][0] . "-" . $informes[$i][1];
                            $balance = $informes[$i][3] - $informes[$i][2];
                            echo "<td>" . $informes[$i][0] . "-" . $informes[$i][1] . "</td>";
                            echo "<td>" . $balance . " €</td>";
                            echo "<td>" . $informes[$i][3] . " €</td>";
                            echo "<td>" . $informes[$i][2] . " €</td>";
                            ?>
                            <td class="text-center">
                              <form action="informe.php" method="POST"><input type="text" class="d-none" name="fecha" value="<?= $fecha ?>"><button type="submit" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-download fa-sm text-white-10"></i></a>
                              </form>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
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

<?php
/*
* FUNCIONES
*/
function selectInformes($dbh)
{
  $sql = 'SELECT anio, mes, gastos, ingresos FROM informes GROUP BY anio, mes, gastos, ingresos';
  $statement = $dbh->prepare($sql);
  $statement->execute();
  return $statement->fetchAll();
}
