<?php

require_once '../twitter.class.php';

// enables caching (path must exists and must be writable!)
// Twitter::$cacheDir = dirname(__FILE__) . '/temp';

$consumerKey = 'uOBcBmCYY5EVaFnOA8Ing';
$consumerSecret = '8Zl3k7UnmQaJSXNqIH7Ak9uirZvHZYMxDb6fI9hqx58';
$accessToken = '345583576-VKjjffTjYZapDU50N3QBOHemndMDQ5ujDS2rNg5i';
$accessTokenSecret = 'AjtEzGhZgeNczE36iDK0Xpf2NGGvfy7YHpFmeFm2Y';

// ENTER HERE YOUR CREDENTIALS (see readme.txt)
$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

$channel = $twitter->load(Twitter::ME_AND_FRIENDS);

?>
<!doctype html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Twitter timeline demo</title>

<ul>
<?php foreach ($channel->status as $status): ?>
	<li><a href="http://twitter.com/<?php echo $status->user->screen_name ?>"><img src="<?php echo htmlspecialchars($status->user->profile_image_url) ?>">
		<?php echo htmlspecialchars($status->user->name) ?></a>:
		<?php echo Twitter::clickable($status->text) ?>
		<small>at <?php echo date("j.n.Y H:i", strtotime($status->created_at)) ?></small>
	</li>
<?php endforeach ?>
</ul>
