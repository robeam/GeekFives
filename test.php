<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>


<title>Falmouth Fives</title>
</head>
<body>
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

			<h3><a href="#comment">Say something&hellip;</a></h3>
			<div id="comments">
				<form method="psot" action="comment.php">
					<input type="text" name="name" value="Whats Your name?" id="commname" />
					<textarea id="comment" width="100%" height="200px" name="comment"></textarea>
					<input type="submit" class="submit" />
				</form>
			</div>

			<hr />

			<h3>Who's playing this week</h3>
				<ul id="playing">
					<?php
					$res=mysql_query("SELECT name,status FROM email");
					$i = 1;
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


