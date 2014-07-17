<?php
require_once('./lib/Stripe.php');

$stripe = array(
  "secret_key"      => "sk_test_4Q8qPMHx7tZ0joGvTVAFvQiP",
  "publishable_key" => "pk_test_4Q8qFIqHGMKsMc5pQfW78piL"
);

Stripe::setApiKey($stripe['secret_key']);
?>