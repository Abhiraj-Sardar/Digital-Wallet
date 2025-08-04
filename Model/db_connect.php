<?php // db_connect.php

$host = 'localhost';
$db = 'wallet';
$user = 'root';
$pass = '';
$attr = "mysql:host=$host;dbname=$db"; //DSN (Data Source Name)

$opts =[
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

?>