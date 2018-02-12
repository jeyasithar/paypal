<?php

if(count($_GET) == 0 && count($_POST) == 0){
	echo '<form method="POST"><input type="submit" name="start" value="Click here to checkout"/></form>';
	exit;
}

include 'nvp.php';




if($_GET['PayerID']){
	
	
	//Do payment start
	
	$fields = array(
	  'VERSION' => '204',
	  'METHOD' => 'DoExpressCheckoutPayment',
	  'PAYMENTACTION' => 'SALE',
	  'PAYERID' => $_GET['PayerID'],
	  'TOKEN' => $_GET['token'],
	  'AMT' => '1',
	);
	
	$result =	sendRequest($fields);	
	echo 'Payment successfull!<br/><br/><pre>';

	print_r($result);
	
	//Do payment end
	
	
} else {
	
	
	//Create payment start
	$fields = array(
	  'VERSION' => '204',
	  'METHOD' => 'SetExpressCheckout',
	  'RETURNURL' => 'https://paypal-jeyasithar.c9users.io/ec.php',
	  'PAYMENTACTION' => 'SALE',
	  'AMT' => '1',
	  'CANCELURL' => 'http://amazon.com'
	);
	
	try {
		$result =	sendRequest($fields);

		echo 'Click here to authorize the payment <a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$result['TOKEN'].'">SetExpressCheckout API flow</a>';
	} catch (HttpException $ex) {
	  echo $ex;
	}
	//Create payment ends

}



