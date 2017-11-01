<?php
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;
use PayPal\Api\Item;
use PayPal\Api\RedirectUrls;
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

$baseUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/thank-you.html")->setCancelUrl("$baseUrl/");

$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Create the full payment object
$payment = new Payment();
$payment->setIntent('sale')
    ->setTransactions(array(
    $transaction
))
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls);


// Create payment with valid API context
try {
    $payment->create($apiContext);
    
    // Get PayPal redirect URL and redirect user
    $approvalUrl = $payment->getApprovalLink();
    
    echo json_encode(['paymentID' => $payment->getId()]);
    
    // REDIRECT USER TO $approvalUrl
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}