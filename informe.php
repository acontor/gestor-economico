<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
} else if($_POST["fecha"] != "") {
  require_once('utils/informe.php');
  require_once('utils/connect_db.php');
  require_once('vendor/autoload.php');
  $fecha = $_POST["fecha"];
  $mpdf = new \Mpdf\Mpdf([]);
  $stylesheet = file_get_contents('src/css/style.css');
  $mpdf->SetTitle('Informe ' . $fecha);
  $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
  $mpdf->writeHtml(crearInforme($fecha, $dbh));
  $mpdf->output('informe-' . $fecha . '.pdf', 'D');
} else {
  header('Location: informes.php');
}