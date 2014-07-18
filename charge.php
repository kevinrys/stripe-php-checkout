<?php

$name = $_POST['customer_fname']." ".$_POST['customer_lname'];
$email = $_POST['customer_email'];
$phone = $_POST['customer_phone'];
$shipping_name = $_POST['shipping_fname']." ".$_POST['shipping_lname'];
$shipping_address = $_POST['shipping_address1']." ".$_POST['shipping_address2'];
$shipping_address2 = $_POST['shipping_city'].", ".$_POST['shipping_state']." ".$_POST['shipping_zip']." ".$_POST['shipping_country'];
$billing_name = $_POST['billing_fname']." ".$_POST['billing_lname'];
$billing_address = $_POST['billing_address1']." ".$_POST['billing_address2'];
$billing_address2 = $_POST['billing_city'].", ".$_POST['billing_state']." ".$_POST['billing_zip']." ".$_POST['billing_country'];
$billing_shipping = $_POST['billing_shipping'];

 error_reporting(E_ALL);
 ini_set("display_errors", 1);

  require_once(dirname(__FILE__) . '/config.php');

  $token  = $_POST['stripeToken'];

  $customer_details = array(
      'Customer Name' => $name,
	  'Customer Phone' => $phone
  );

  $address1 = array(
  	  'Shipping Name' => $shipping_name,
      'Shipping Address' => $shipping_address,
	  'Shipping Address 2' => $shipping_address2
  );
  
    if ($billing_shipping === 'same') { 
  	  $billing_name = $shipping_name;
	  $billing_address = $shipping_address;
	  $billing_address2 = $shipping_address2;
	 }
  
  $address2 = array(
  	  'Billing Name' => $billing_name,
	  'Billing Address' => $billing_address,
	  'Billing Address 2' => $billing_address2
  );
  
  $customer = Stripe_Customer::create(array(
      'email' => $email,
	  'metadata' => $customer_details + $address1 + $address2,
      'card'  => $token
  ));


  $charge = Stripe_Charge::create(array(
      'customer' => $customer->id,
      'amount'   => 2000,
      'currency' => 'usd',
	));

  echo '<h1>Successfully charged $20.00!</h1>';
?>