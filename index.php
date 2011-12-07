<?php
include "include.php";

function post_tweet($authData, $data) {
	$connection = new tmhOAuth($authData); 
	$connection->request('POST', $connection->url('1/statuses/update'), $data);
	return $connection->response['code'];
}

if( $_POST['tweet'] ) {
	$text = trim($_POST['tweet']);
	$emotion = substr($text, -1) == "?" ? "confusion" : "anger";
	$text = trim($_POST['tweet'], "?!") . ($emotion == "confusion" ? "?!?" : "!!!") .  "\n(╯°□°)╯︵ ┻━┻";
	$text = strtoupper($text);

	if( trim($_POST['reply-to']) == "") {
		$result = post_tweet($authData, array('status'=>$text));		
	} else {
		$result = post_tweet($authData, array('status'=>$text, 'in_reply_to_status_id'=>trim($_POST['reply-to'])));
	}
}
?>
<!DOCTYPE html>
<meta charset=utf-8>
<title>FLIPPIN' TABLES</title>
<?php if( $result ): ?>
	<p>Tweet sent, response was <?= $result ?>.</p>
<?php endif; ?>
<form method=post>
	<p>Replying to: <input name=reply-to></p>
	<input size=124 maxlength=124 name=tweet autofocus><button type=submit>(╯°□°)╯︵ ┻━┻</button>
</form>