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
  <link href="src/css/style.css" rel="stylesheet">

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
          <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Informe</h1>
            </div>
            <div class="container-fluid">
              <div class="card shadow mb-4">
                <?php
                require_once('utils/connect_db.php');
                $html = '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead">
              <tr>
                <th colspan="6" class="text-center text-white">BALANCE</th>
              </tr>
              <tr>
                <th colspan="3" class="text-center">INGRESOS</th>
                <th colspan="3" class="text-center">GASTOS</th>
              </tr>
              <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Cantidad</th>
              </tr>
            </thead>
            <tbody>';
                $fecha = $_POST['fecha'];
                $gastos = selectMovimientosGastos($dbh, $fecha);
                $ingresos = selectMovimientosIngresos($dbh, $fecha);
                $num_gastos = sizeof($gastos);
                $num_ingresos = sizeof($ingresos);
                $total_gastos = selectTotalGastos($dbh, $fecha)[0];
                $total_ingresos = selectTotalIngresos($dbh, $fecha)[0];
                if ($total_gastos == "") {
                  $total_gastos = 0;
                }
                if ($total_ingresos == "") {
                  $total_ingresos = 0;
                }
                $balance = $total_ingresos - $total_gastos;
                if ($num_gastos > $num_ingresos) {
                  for ($i = 0; $i < $num_gastos; $i++) {
                    $html .= '<tr>';
                    if ($i >= $num_ingresos) {
                      $html .= '<td></td><td></td><td></td>';
                    } else {
                      $html .= '<td>' . $ingresos[$i][0] . '</td><td>' . $ingresos[$i][1] . '</td><td>' . $ingresos[$i][2] . ' €</td>';
                    }
                    $html .= '<td>' . $gastos[$i][0] . '</td><td>' . $gastos[$i][1] . '</td><td>' . $gastos[$i][2] . ' €</td></tr>';
                  }
                } else if ($num_gastos < $num_ingresos) {
                  for ($i = 0; $i < $num_ingresos; $i++) {
                    $html .= '<tr><td>' . $ingresos[$i][0] . '</td><td>' . $ingresos[$i][1] . '</td><td>' . $ingresos[$i][2] . ' €</td>';
                    if ($i >= $num_gastos) {
                      $html .= '<td></td><td></td><td></td>';
                    } else {
                      $html .= '<td>' . $gastos[$i][0] . '</td><td>' . $gastos[$i][1] . '</td><td>' . $gastos[$i][2] . ' €</td></tr>';
                    }
                  }
                } else {
                  for ($i = 0; $i < $num_ingresos; $i++) {
                    $html .= '<tr><td>' . $ingresos[$i][0] . '</td><td>' . $ingresos[$i][1] . '</td><td>' . $ingresos[$i][2] . ' €</td><td>' . $gastos[$i][0] . '</td><td>' . $gastos[$i][1] . '</td><td>' . $gastos[$i][2] . ' €</td></tr>';
                  }
                }
                $html .= '</tbody>
            <tfoot>
              <tr>
                <td colspan="2" class="texto-td">Total de ingresos:</td>
                <td>' . $total_ingresos . ' €</td>
                <td colspan="2" class="texto-td">Total de gastos:</td>
                <td>' . $total_gastos . ' €</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td class="texto-td">BALANCE:</td>
                <td> ' . $balance . ' €</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tfoot>
          </table>';
                echo $html;
                ?>
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

<?php
/*
* FUNCIONES
*/
function selectMovimientosGastos($dbh, $fecha)
{
  $a_fecha = explode('-', $fecha);
  $sql = 'SELECT fecha, descripcion, cantidad, tipo FROM movimientos WHERE id_user = ? AND EXTRACT(YEAR FROM fecha) = ? AND EXTRACT(MONTH FROM fecha) = ? AND tipo = ?';
  $statement = $dbh->prepare($sql);
  $statement->execute(array($_SESSION["username"], $a_fecha[0], $a_fecha[1], "Gastos"));
  return $statement->fetchAll();
}
function selectMovimientosIngresos($dbh, $fecha)
{
  $a_fecha = explode('-', $fecha);
  $sql = 'SELECT fecha, descripcion, cantidad, tipo FROM movimientos WHERE id_user = ? AND EXTRACT(YEAR FROM fecha) = ? AND EXTRACT(MONTH FROM fecha) = ? AND tipo = ?';
  $statement = $dbh->prepare($sql);
  $statement->execute(array($_SESSION["username"], $a_fecha[0], $a_fecha[1], "Ingresos"));
  return $statement->fetchAll();
}
function selectTotalGastos($dbh, $fecha)
{
  $a_fecha = explode('-', $fecha);
  $sql = 'SELECT sum(cantidad) FROM movimientos WHERE id_user = ? AND EXTRACT(YEAR FROM fecha) = ? AND EXTRACT(MONTH FROM fecha) = ? AND tipo = ?';
  $statement = $dbh->prepare($sql);
  $statement->execute(array($_SESSION["username"], $a_fecha[0], $a_fecha[1], "Gastos"));
  return $statement->fetch();
}
function selectTotalIngresos($dbh, $fecha)
{
  $a_fecha = explode('-', $fecha);
  $sql = 'SELECT sum(cantidad) FROM movimientos WHERE id_user = ? AND EXTRACT(YEAR FROM fecha) = ? AND EXTRACT(MONTH FROM fecha) = ? AND tipo = ?';
  $statement = $dbh->prepare($sql);
  $statement->execute(array($_SESSION["username"], $a_fecha[0], $a_fecha[1], "Ingresos"));
  return $statement->fetch();
}
