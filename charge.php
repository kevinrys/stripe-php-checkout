<?php

$name = $_POST['customer_fname']." ".$_POST['customer_lname'];
$email = $_POST['customer_email'];
$shipping_address = $_POST['shipping_address1']." ".$_POST['shipping_address2'];
$shipping_city = $_POST['shipping_city'];
$shipping_state = $_POST['shipping_state'];
$shipping_zip = $_POST['shipping_zip'];
$shipping_country = $_POST['shipping_country'];
$billing_address = $_POST['billing_address1']." ".$_POST['billing_address2'];
$billing_city = $_POST['billing_city'];
$billing_state = $_POST['billing_state'];
$billing_zip = $_POST['billing_zip'];
$billing_country = $_POST['billing_country'];
$billing_shipping = $_POST['billing_shipping'];

 error_reporting(E_ALL);
 ini_set("display_errors", 1);

  require_once(dirname(__FILE__) . '/config.php');

  $token  = $_POST['stripeToken'];

  $customer_details = array(
      'Customer Name' => $name
  );

  $address1 = array(
      'Shipping Address' => $shipping_address,
	  'Shipping City' => $shipping_city,
	  'Shipping State' => $shipping_state,
	  'Shipping Zip Code' => $shipping_zip,
	  'Shipping Country' => $shipping_country,
  );
  
    if ($billing_shipping === 'same') { 
  	  $billing_address = $shipping_address;
	  $billing_city = $shipping_city;
	  $billing_state = $shipping_state;
	  $billing_zip = $shipping_zip;
	  $billing_country = $shipping_country;
	 }
  
  $address2 = array(
	  'Billing Address' => $billing_address,
	  'Billing City' => $billing_city,
	  'Billing State' => $billing_state,
	  'Billing Zip Code' => $billing_zip,
	  'Billing Country' => $billing_country,
  );
  
  $customer = Stripe_Customer::create(array(
      'email' => $email,
	  'metadata' => $customer_details + $address1 + $address2,
      'card'  => $token
  ));

  $charge = Stripe_Charge::create(array(
      'customer' => $customer->id,
      'amount'   => 2000,
      'currency' => 'usd'
  ));

  echo '<h1>Successfully charged $20.00!</h1>';
?>