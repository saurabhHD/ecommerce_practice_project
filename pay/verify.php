<?php

require('config.php');

session_start();
$id = $_GET['id'];
$title = $_GET['title'];
$brand = $_GET['brand'];
$amount = $_GET['amount'];
$qnt = $_GET['qnt'];
$fullname = $_GET['fullname'];
$username = $_GET['username'];
$mobile = $_GET['mobile'];
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    header("Location:purchase_entry.php?id=".$id."&title=".$title."&brand=".$brand."&amount=".$amount."&qnt=".$qnt."&fullname=".$fullname."&username=".$username."&mobile=".$mobile."&payment_mode=online");
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
