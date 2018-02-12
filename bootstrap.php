<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// Autoload SDK package for composer based installations
require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$apiContext = new ApiContext(new OAuthTokenCredential(getenv('CLIENT_ID'), getenv('SECRET')));

