<?php
// CONNECT TO THE DATABASE
include_once ('db-connect.php');
$a = $_GET['name'];
$b = $_GET['comment'];

mysql_query("INSERT INTO comments (name,comment) VALUES ('$a','$b')");
echo 'success';


?> 