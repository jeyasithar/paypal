<?php

require 'bootstrap.php';


function sendRequest($fields)
{
	$fields = array_merge($fields, array(
	  'USER' => getenv('API_USER'),
	  'PWD' => getenv('API_PASSWORD'),
	  'SIGNATURE' => getenv('API_SIGNATURE'))
	  );
	$client = new \GuzzleHttp\Client();
	$headers = array(
	  'content-type' => 'application/x-www-form-urlencoded'
	);
	
	$response =	$client->request('POST', $url ?: 'https://api-3t.sandbox.paypal.com/nvp', ['form_params' => $fields, 'headers' => $headers] );

	parse_str($response->getBody(), $result);
	
	return $result;
}