<?php
$currency = '$'; //Currency Character or code
//
//paypal settings
$PayPalMode 			= 'sandbox'; // sandbox or live
$PayPalApiUsername 		= 'tanner.wilkerson-facilitator_api1.uky.edu'; //PayPal API Username
$PayPalApiPassword 		= '4BP3MXWPGASLNHQF'; //Paypal API password
$PayPalApiSignature 	= 'AFcWxV21C7fd0v3bYYYRCpSSRl31AzjwN92oR2pUgxbQ-Q8pHR73eQox'; //Paypal API Signature
$PayPalCurrencyCode 	= 'USD'; //Paypal Currency Code
$PayPalReturnURL 		= 'https://www.anderskitchen.com/paypal-express-checkout/'; //Point to paypal-express-checkout page
$PayPalCancelURL 		= 'https://www.anderskitchen.com/paypal-express-checkout/cancel_url.html'; //Cancel URL if user clicks cancel

//Additional taxes and fees											
$HandalingCost 		= 0.00;  //Handling cost for the order.
$InsuranceCost 		= 0.00;  //shipping insurance cost for the order.
$shipping_cost      = 5.00; //delivery fee (paypal only recognizes the 'shipping' option)
$ShippinDiscount 	= 0.00; //Shipping discount for this order. Specify this as negative number (eg -1.00)
$taxes              = 7;

$profitMultiplier = 1.5;
?>
