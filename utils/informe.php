<?php
function crearInforme($fecha, $dbh)
{
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
  return $html;
}


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
