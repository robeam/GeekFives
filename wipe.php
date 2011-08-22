<?php
// CONNECT TO THE DATABASE
include_once ('admin/db-connect.php');
mysql_query("TRUNCATE TABLE email;");
mysql_query("TRUNCATE TABLE date;");
mysql_query("TRUNCATE TABLE comments;");

echo 'Thats all clean, ready for next week.';
?>