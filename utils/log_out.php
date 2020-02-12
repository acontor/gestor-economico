<?php
session_start();
session_destroy();
$msg = "<div class='alert alert-success mt-4' role='alert'>Has terminado tu sesión satisfactoriamente.</div>";
$url = "Location: ../index.php?msg=$msg";
header($url);
