<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// Autoload SDK package for composer based installations
require 'vendor/autoload.php';

$apiContext = new ApiContext(new OAuthTokenCredential('AbL1sjo8V7SLNGseTPj2cac4cRW_b3eUEkadTvqVLyqSPWsAJwoh5LD8R68dLrhARYCaEd7YOv8JiVOk', 'EH779C7DcMhWz0OnbmyUpu4O2p-fT5B-nVXbTSFf0LovESVT9d_1Mgr4ZevOYva5jCtjEBpuFSgf0_ox'));