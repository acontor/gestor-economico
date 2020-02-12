<?php
session_start();
require_once('connect_db.php');
$costumername = $_POST['username'];
$password = $_POST['password'];
$sql = 'SELECT password FROM users WHERE username=?';
$statement = $dbh->prepare($sql);
$statement->execute(array($costumername));
$result = $statement->fetch();
if (!password_verify($password, $result[0])) {
  $msg = "<div class='alert alert-warning mt-3' role='alert'>Su nombre de usuario o contraseña son incorrectos. Inténtalo de nuevo.</div>";
  $url = "Location: ../index.php?msg=$msg";
} else {
  session_start();
  $_SESSION['username'] = $costumername;
  $url = "Location: ../informes.php";
}
header($url);
