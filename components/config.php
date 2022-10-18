<?php
$user_name = "root";
$user_password="";
$dsn = 'mysql:dbname=shop_db;host=127.0.0.1:3307';

$conn = new PDO($dsn, $user_name, $user_password);

?>