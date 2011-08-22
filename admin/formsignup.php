<?php
// CONNECT TO THE DATABASE
include_once ('db-connect.php');

require_once 'twitter/twitter.class.php';

$consumerKey = 'uOBcBmCYY5EVaFnOA8Ing';
$consumerSecret = '8Zl3k7UnmQaJSXNqIH7Ak9uirZvHZYMxDb6fI9hqx58';
$accessToken = '345583576-wzlN6lG4yFmAjyTqyVneQpVFoeTbXXLdESoe9nLP';
$accessTokenSecret = 'faR0Y7tP0zXOp8SzDQaICq5dlTf2dztJNbmis7RoQk';
$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

$a = $_GET['player'];

if($a === '')
{
	echo 'empty';
	exit;
} 
else
{
	$res=mysql_query("SELECT name FROM email WHERE name = '$a'");
	$row=mysql_fetch_assoc($res);
	$name = $row['name'];
	if($a !== $name){
		mysql_query("INSERT INTO email (name,status) VALUES ('$a','true')");
		if (!$twitter->authenticate()) {
        	die('Invalid name or password');
		} else {
			$res=mysql_query("SELECT name FROM email");
			$playnum = mysql_num_rows($res);
			echo 'playing';
			if($playnum < 10){
				$message = $a .' is in, we now have ' . $playnum . ' players for this weeks game';
				$twitter->send($message);
			} else if ($playnum == 10){
				$message = $a .' is in, we have 5 aside this week!';
				$twitter->send($message);
			} else if ($playnum > 10){
				$message = $a .' is in, we have ' . $playnum . ' players for this weeks game';
				$twitter->send($message);
			}	
		}
	} else {
		echo 'dupe, your already playing?';
		exit();
	}
}
?> 