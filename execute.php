<?php
require __DIR__ . '/bootstrap.php';
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

// Get payment object by passing paymentId
$paymentId = $_POST['paymentID'];
$payment = Payment::get($paymentId, $apiContext);
$payerId = $_POST['payerID'];

// Execute payment with payer id
$execution = new PaymentExecution();
$execution->setPayerId($payerId);

try {
    // Execute payment
    $result = $payment->execute($execution, $apiContext);
    echo json_encode(['state' => $result->getState()]);
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}