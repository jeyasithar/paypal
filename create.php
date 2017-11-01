<?php
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
// Autoload SDK package for composer based installations
require 'vendor/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    'AbL1sjo8V7SLNGseTPj2cac4cRW_b3eUEkadTvqVLyqSPWsAJwoh5LD8R68dLrhARYCaEd7YOv8JiVOk',
    'EH779C7DcMhWz0OnbmyUpu4O2p-fT5B-nVXbTSFf0LovESVT9d_1Mgr4ZevOYva5jCtjEBpuFSgf0_ox'
  )
);



// Create new payer and method
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// Set redirect urls
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl('http://localhost:3000/process.php')
  ->setCancelUrl('http://localhost:3000/cancel.php');

// Set payment amount
$amount = new Amount();
$amount->setCurrency("USD")
  ->setTotal(10);

// Set transaction object
$transaction = new Transaction();
$transaction->setAmount($amount)
  ->setDescription("Payment description");

// Create the full payment object
$payment = new Payment();
$payment->setIntent('sale')
  ->setPayer($payer)
  ->setRedirectUrls($redirectUrls)
  ->setTransactions(array($transaction));