<?php
$host = 'ec2-46-137-177-160.eu-west-1.compute.amazonaws.com';
$dbname = 'deod10l4p8m3cq';
$user = 'qrwqmcubwdjfvd';
$password = '1f2b60998e9c2403511f5c2f5e684e8ddbacff9be39d996a23e03debc4400643';
$dbh = new PDO('pgsql:host=' . $host . ';dbname=' . $dbname, $user, $password);