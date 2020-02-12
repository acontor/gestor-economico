<?php
session_start();
require_once('connect_db.php');
$costumername = $_POST['username'];
$password = $_POST['password'];
$costumername_regex = '/^[A-Za-z][A-Za-z0-9]{3,31}$/';
$password_regex = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
if (preg_match($costumername_regex, $costumername) === 0) {
  $msg = "<div class='alert alert-warning mt-3' role='alert'><p>Tu nombre de usuario:</p><ul><li>Debe empezar por una letra.</li><li>Debe ser de 4 a 32 caractéres.</li><li>Puede contener letras y números.</li></ul></div>";
  $url = "Location: ../sign_up.php?msg=$msg";
} elseif (preg_match($password_regex, $password) === 0) {
  $msg = "<div class='alert alert-warning mt-3' role='alert'><p>Tu contraseña:</p><ul><li>Debe tener un mínimo de 8 caracteres.</li><li>Debe contener al menos 1 número.</li><li>Debe contener al menos un carácter en mayúscula.</li></ul></div>";
  $url = "Location: ../sign_up.php?msg=$msg";
} else {
  $hashPassword = password_hash($password, PASSWORD_BCRYPT);
  $sql = 'INSERT INTO users(username,password) values(?,?)';
  $statement = $dbh->prepare($sql);
  $success = $statement->execute(array($costumername, $hashPassword));
  if ($success) {
    $msg = "<div class='alert alert-success mt-3' role='alert'>Usuario creado correctamente.</div>";
    $url = "Location: ../index.php?msg=$msg";
  } else {
    $msg = "<div class='alert alert-warning mt-3' role='alert'>Hubo un error durante el registro. Tal vez el nombre de usuario ya existe.</div>";
    $url = "Location: ../index.php?msg=$msg";
  }
}
header($url);
