<?php
session_start();
require_once('connect_db.php');
$usuario = $_SESSION["username"];
$tipo = $_POST["tipo"];
$fecha = $_POST["fecha"];
$cantidad = $_POST["cantidad"];
$descripcion = $_POST["descripcion"];
if ($fecha == "" || $cantidad == "" || $descripcion == "" || ($tipo != "Gastos" && $tipo != "Ingresos")) {
  $msg = "<div class='alert alert-warning mt-4' role='alert'>¡Error! Rellena todos los campos correctamente para guardar el movimiento.</div>";
} else {
  $a_fecha = explode('-', $fecha);
  if(comprobarInforme($dbh, $a_fecha) == "") {
    crearInforme($dbh, $a_fecha, $usuario);
  }
  $informe = comprobarInforme($dbh, $a_fecha);
  $sql = 'INSERT INTO movimientos(id_informe, id_user, tipo, fecha, descripcion, cantidad) values(?,?,?,?,?,?)';
  $statement = $dbh->prepare($sql);
  $statement->execute(array($informe[0], $usuario, $tipo, $fecha, $descripcion, $cantidad));
  actualizarInforme($dbh, $informe[0], $informe[1], $informe[2], $tipo, $cantidad);
  $msg = "<div class='alert alert-success mt-4' role='alert'>Movimiento insertado correctamente.</div>";
}
$url = "Location: ../gasto.php?msg=$msg";
header($url);


function comprobarInforme($dbh, $a_fecha)
{
  $sql = 'SELECT id, gastos, ingresos FROM informes WHERE anio =? AND mes =? GROUP BY id';
  $statement = $dbh->prepare($sql);
  $statement->execute(array($a_fecha[0], $a_fecha[1]));
  return $statement->fetch();
}

function crearInforme($dbh, $a_fecha, $usuario)
{
  $sql = 'INSERT INTO informes(id_user, anio, mes, ingresos, gastos) values(?,?,?,?,?)';
  $statement = $dbh->prepare($sql);
  return $statement->execute(array($usuario, $a_fecha[0], $a_fecha[1], 0, 0));
}

function actualizarInforme($dbh, $id, $gastos, $ingresos, $tipo, $cantidad)
{
  if ($tipo == "Gastos") {
    $sql = 'UPDATE informes SET gastos = ? WHERE id = ?';
    $cantidad = $gastos + $cantidad;
  } else {
    $sql = 'UPDATE informes SET ingresos = ? WHERE id = ?';
    $cantidad = $ingresos + $cantidad;
  }
  $statement = $dbh->prepare($sql);
  return $statement->execute(array($cantidad, $id));
}
