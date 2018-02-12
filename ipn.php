<?php


require 'nvp.php';

parse_str(file_get_contents('php://input'), $result);

$client = new \GuzzleHttp\Client();

$content = '';

foreach($result as $key => $value){
	$content .= "*$key* = $value \n";
}

$client->request('POST', 'https://paypal.slack.com/services/hooks/slackbot?token='.getenv('SLACK_TOKEN').'&channel=@jramalingam', ['body' => $content]);