<?php
	include_once ('../db-connect.php');
	//CHECK TWITTER FOR PLAYERS
	require_once 'twitter.class.php';
	$consumerKey = 'uOBcBmCYY5EVaFnOA8Ing';
	$consumerSecret = '8Zl3k7UnmQaJSXNqIH7Ak9uirZvHZYMxDb6fI9hqx58';
	$accessToken = '345583576-wzlN6lG4yFmAjyTqyVneQpVFoeTbXXLdESoe9nLP';
	$accessTokenSecret = 'faR0Y7tP0zXOp8SzDQaICq5dlTf2dztJNbmis7RoQk';
	$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

	$channel = $twitter->load(Twitter::REPLIES);
	foreach ($channel->status as $status) {
		
		$a = $status->user->name;
		$con = strstr($status->text, '#');
		$screen = $status->user->screen_name;

    	if($con === '#playing'){
    			$res=mysql_query("SELECT name FROM email WHERE name = '$a'");
				$row=mysql_fetch_assoc($res);
				$name = $row['name'];
				echo $a, $name;
				exit;
				if($a !== $name){
					mysql_query("INSERT INTO email (name,status) VALUES ('$a','true')");
					
					$res=mysql_query("SELECT name FROM email");
					$playnum = mysql_num_rows($res);

					if($playnum < 10){
						$message = '@' . $screen .' your playing, in at number ' . $playnum;
						$twitter->send($message);	
					} else {
						$message = '@' . $screen .' your on the subs bench, in at number ' . $playnum;
						$twitter->send($message);	
					}
					echo 'in';
				} else {
					$message = '@' . $screen .' your already playing sir?';
					$twitter->send($message);
					echo 'dupe';
				}
    	} else if($con === '#out') {
				// DELETE a row of information into the Database
				mysql_query("DELETE FROM email WHERE name = '$a'");

				$message = '@' . $screen .' Your out!';
				$twitter->send($message);
				echo 'deleted';
    	}
	}	
?>