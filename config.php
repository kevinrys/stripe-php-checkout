<?php
require_once('./lib/Stripe.php');

/* REPLACE STRIPE_SECRET_KEY AND STRIPE_SECRET_KEY WITH YOUR CREDENTIALS */

$stripe = array(
  "secret_key"      => "STRIPE_SECRET_KEY",
  "publishable_key" => "STRIPE_PRIVATE_KEY"
);

Stripe::setApiKey($stripe['secret_key']);
?>