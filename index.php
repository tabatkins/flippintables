<?php
include "include.php";

function post_tweet($tweet_text) {
	$connection = new tmhOAuth($authData); 

	$connection->request('POST', 
		$connection->url('1/statuses/update'), 
		array('status' => $tweet_text));
	
	return $connection->response['code'];
}

if( $_POST['tweet'] ) {
	$text = trim($_POST['tweet']);
	$emotion = substr($text, -1) == "?" ? "confusion" : "anger";
	$text = trim($_POST['tweet'], "?!") . ($emotion == "confusion" ? "?!?" : "!!!") .  "\n(╯°□°)╯︵ ┻━┻";
	$text = strtoupper($text);
	$result = post_tweet($text);
}
?>
<!DOCTYPE html>
<meta charset=utf-8>
<title>FLIPPIN' TABLES</title>
<?php if( $result ): ?>
	<p>Tweet sent, response was <?= $result ?>.</p>
<?php endif; ?>
<form method=post>
	<input size=124 maxlength=124 name=tweet autofocus><button type=submit>(╯°□°)╯︵ ┻━┻</button>
</form>