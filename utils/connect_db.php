<?php
$host = '';
$dbname = '';
$costumername = '';
$password = '';
// MySQL/MariaDB
// $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $costumername, $password);
// PostgreSQL
$dbh = new PDO('pgsql:host=' . $host . ';dbname=' . $dbname, $costumername, $password);