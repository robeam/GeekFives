<?php
// CONNECT TO THE DATABASE
include_once ('db-connect.php');

require_once 'twitter/twitter.class.php';
$consumerKey = 'uOBcBmCYY5EVaFnOA8Ing';
$consumerSecret = '8Zl3k7UnmQaJSXNqIH7Ak9uirZvHZYMxDb6fI9hqx58';
$accessToken = '345583576-wzlN6lG4yFmAjyTqyVneQpVFoeTbXXLdESoe9nLP';
$accessTokenSecret = 'faR0Y7tP0zXOp8SzDQaICq5dlTf2dztJNbmis7RoQk';

$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

// TITLE

$a = $_GET['name'];
echo 'out';
// DELETE a row of information into the Database
mysql_query("DELETE FROM email WHERE name = '$a'");

$res=mysql_query("SELECT name FROM email");
$playnum = mysql_num_rows($res);

$message = $a .' is out, were down to ' . $playnum . ' players for this weeks game';
$twitter->send($message);

?>
