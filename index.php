<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>


<title>Falmouth Fives</title>
</head>
<body class="no-js">
<?php include_once ('admin/db-connect.php'); ?>
<div id="wrapper">
	<header role="banner">
		<h1>Falmouth Fives 5-A-Side Football</h1>
		<h3>Next game:
		<span id="date" class="green">
		<?php
			date_default_timezone_set('Europe/London');
			$playtime = date("l d F", strtotime("next Tuesday"));
			$today = date("l");
			if($today !== 'Tuesday'){
				echo $playtime;
			} else {
				echo 'Today';
			}
		?>
		</span>- 7.00pm - 8ish Tremough Campus</h3>
	</header>	
	<div id="content">
		<section role="sign up">
			<h2>Sign up for 
				<?php
					$playtime = date("l d F", strtotime("next Tuesday"));
					$today = date("l");
					if($today !== 'Tuesday'){
						echo $playtime;
					} else {
						echo 'Today';
					}
				?>
			</h2>
			
			<div role="enter">
				<form id="playing" method="post" action="admin/formsignup.php">
					<input type="text" class="name" name="player" placeholder="Whats your name?" />
					<input type="submit" id="play" value="Sign me up" />
				</form>
			</div>
			
			<hr />
			<ul id="playing">
				<?php
					//CHECK TWITTER FOR PLAYERS
					require_once 'admin/twitter/twitter.class.php';
					$consumerKey = 'uOBcBmCYY5EVaFnOA8Ing';
					$consumerSecret = '8Zl3k7UnmQaJSXNqIH7Ak9uirZvHZYMxDb6fI9hqx58';
					$accessToken = '345583576-wzlN6lG4yFmAjyTqyVneQpVFoeTbXXLdESoe9nLP';
					$accessTokenSecret = 'faR0Y7tP0zXOp8SzDQaICq5dlTf2dztJNbmis7RoQk';
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

					$channel = $twitter->load(Twitter::REPLIES);
					foreach ($channel->status as $status) {
						$con = strstr($status->text, '#');
						$from = strstr($status->text, '@');
						echo $status;
	                	if($con === '#playing'){
	                		
	                	}
	       			}	
				?>
				<?php
					$res=mysql_query("SELECT name,status FROM email");
					$n = mysql_num_rows($res);
					$i = 1;
					if($n<10){
						echo "<h2>Who's playing this week</h2>";
					} else if($n<12) {
						echo "<h2>We have teams! We could squeeze a couple more in&hellip;</h2>";
					} else {
						echo "<h2>We have full teams! you'll have to be a sub and hope someone drops out.</h2>";
					}
					while ($row=mysql_fetch_assoc($res)) {
						if($row['status']=='false'){
							echo '';
						} else {
							if($i>12){ $class="sub"; } else { $class = 'teamPlayer'; }
							echo '<li class="' . $class . '"><form method="post" action="admin/delete.php"><input type="text" class="players" value="' .$row['name'] . '" readonly="readonly" name="name" /><input class="dropper" type="submit" value="drop-me" /></form></li>';
							$i++;
						}
					}
	 			?>
			</ul>
			<hr />
			<em>Follow <a href="http://twitter.com/@falmouthfives">@falmouthfives</a></em>
			<hr />
		</section>

		<h2 class="clickme"><a href="comments">Make a comment &raquo;</a></h2>
		<section role="comments" id="comments">
			<form method="post" action="admin/comment.php">
				<label for="commentator">Enter your name, or click on it above if your down to play</label>
				<input type="text" name="name" class="text" id="commentator" placeholder="Whats your name, or click on it above if your playing" />
				<textarea id="comment"></textarea>
				<input type="submit" name="submit" value="Make comment" />
			</form>
		</section>

		<section role="comments-made">
			<?php
				$res=mysql_query("SELECT name,comment,id FROM comments");
				while ($row=mysql_fetch_assoc($res)) {
					if($row['name'] == ''){
					} else {
						echo '<blockquote class="quote" id="comment-' . $row['id'] . '"><cite>' . $row['name'] . ' said - </cite>' . $row['comment'] . '</blockquote>';	
					}
				}
	 			?>
		</section>
	</div>
	<footer>
	<span class="delete"></span>	
	</footer>
<!--
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAA9smoFNj_Rf5Q-0Vom36veBTcDZ6dWvwXJfopYEkv4zW9piE-3hQ2EQWWB8yKrdfGvq1a1636PgnoAg"></script>
<script type="text/javascript">google.load("jquery", "1.4");</script>
<script type="text/javascript" src="js/jFunctions.js"></script>
-->
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="js/jFunctions.js"></script>
<script type="text/javascript" src="js/cookies.jquery.js"></script>
</div>

<div id="warning"></div>

</body>
</html>


