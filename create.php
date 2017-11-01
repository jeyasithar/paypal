<?php
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;
use PayPal\Api\Item;
// Autoload SDK package for composer based installations
require __DIR__ . '/bootstrap.php';

// Create new payer and method
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// Set payment amount
$amount = new Amount();
$amount->setCurrency("USD")->setTotal(10.99);

// Set transaction object
$transaction = new Transaction();
$transaction->setAmount($amount);

$transaction->setInvoiceNumber(uniqid());

$item = new Item();
$item->setName("Macbook cover");
$item->setDescription("macbook pro cover.");
$item->setQuantity(1);
$item->setPrice("10.99");
$item->setCurrency("USD");

$itemList = new ItemList();
$itemList->addItem($item);
$itemList->setShippingAddress($_POST['address']);
$transaction->setItemList($itemList);

// Create the full payment object
$payment = new Payment();
$payment->setIntent('sale')->setTransactions(array(
    $transaction
));

$payer = new Payer();
$payer->setPaymentMethod('paypal');
$payment->setPayer($payer);

// Create payment with valid API context
try {
    $payment->create($apiContext);
    
    // Get PayPal redirect URL and redirect user
    $approvalUrl = $payment->getApprovalLink();
    
    // REDIRECT USER TO $approvalUrl
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}