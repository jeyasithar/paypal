<?php
require __DIR__ . '/bootstrap.php';
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

// Get payment object by passing paymentId
$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);
$payerId = $_GET['PayerID'];

// Execute payment with payer id
$execution = new PaymentExecution();
$execution->setPayerId($payerId);

try {
    // Execute payment
    $result = $payment->execute($execution, $apiContext);
    var_dump($result);
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}