<?php

require 'nvp.php';

parse_str(file_get_contents('php://input'), $result);


$content = '';

$result['cmd'] = '_notify-validate';

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr', ['form_params' => $result, 'headers' => ['content-type' => 'application/x-www-form-urlencoded']] );

if($response->getBody() == "VERIFIED"){
	foreach($result as $key => $value){
		$content .= "*$key* = $value \n";
	}
} else {
	$content = $response->getBody().". This is not a valid IPN received";
}

$client->request('POST', 'https://paypal.slack.com/services/hooks/slackbot?token='.getenv('SLACK_TOKEN').'&channel=@jramalingam', ['body' => $content]);