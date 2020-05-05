<?php
$stripeToken = ltrim(rtrim(filter_input(INPUT_POST, "stripeToken", FILTER_SANITIZE_STRING)));
if (empty($stripeToken)) {
    header("location: index.php"); // deal with invalid input
    exit();
}

$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING)));
if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
    header("location: index.php"); // deal with invalid input
    exit();
}

$numberOfProductA = filter_input(INPUT_POST, "numberOfProductA", FILTER_SANITIZE_NUMBER_INT);
if (!isset($numberOfProductA)) {
    if (!filter_var($numberOfProductA, FILTER_VALIDATE_INT)) {
        header("location: index.php"); // deal with invalid input
        exit();
    }
}

$numberOfProductB = filter_input(INPUT_POST, "numberOfProductB", FILTER_SANITIZE_NUMBER_INT);
if (!isset($numberOfProductB)) {
    if (!filter_var($numberOfProductB, FILTER_VALIDATE_INT)) {
        header("location: index.php"); // deal with invalid input
        exit();
    }
}

$paymentAmount = filter_input(INPUT_POST, "paymentAmount", FILTER_SANITIZE_NUMBER_INT);
if (!isset($paymentAmount)) {
    if (!filter_var($paymentAmount, FILTER_VALIDATE_INT)) {
        header("location: index.php"); // deal with invalid input
        exit();
    }
}

require_once 'configuration.php';
// make stripe payment
require_once('./Stripe/init.php');
\Stripe\Stripe::setApiKey($privateStripeKey);
try {
    $charge = \Stripe\Charge::create(array(
                "amount" => $paymentAmount . "00",
                "currency" => "eur",
                "card" => $stripeToken,
                "description" => "Stripe Sales Example")
    );
} catch (Stripe_CardError $e) {
    echo("Your card has been declined.<br>Error Details: " . $e . "<br><br><a href='index.php'>Click here to continue</a>");
    die();
} catch (Exception $e) {
    echo("Your card has been declined.<br>Error Details: " . $e . "<br><br><a href='index.php'>Click here to continue</a>");
    die();
}
// end of Stripe payment code
?>




<!DOCTYPE html>
<html>
    <head>
        <title>Stripe Example</title>  
        <link href="assets/demo.css" rel="stylesheet" type="text/css"/>
        <link href="assets/form-validation.css" rel="stylesheet" type="text/css"/>
        <link href="assets/awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/main.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="./assets/dkit.png">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href="../css/progress-wizard.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/progress_bar.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="main-content">

            <form class="form-validation" id="dor_payment_form">
                <h2><img style="vertical-align: middle;height:2.5em" src="./assets/dkit.png" alt=""/> Stripe Example</h2>

                <!-- Progress Bar -->
                <ul class="progress-indicator custom-complex">
                    <li class="completed">
                        <span class="bubble"></span>
                        <i class="fa fa-check-circle"></i>
                        1. REGISTER
                    </li>
                    <li class="completed">
                        <span class="bubble"></span>
                        <i class="fa fa-check-circle"></i>
                        2. PAYMENT
                    </li>
                    <li class="completed">
                        <span class="bubble"></span>
                        <i class="fa fa-check-circle"></i>
                        3. CONFIRMATION
                    </li>
                </ul>
                <!-- End of Progress Bar -->

                <p>Your payment is confirmed. Thank you for your order.</p>
                <a href="http://www.dkit.ie">Click here to return to our website</a>
            </form>

        </div> 
    </body>

    <?php
// send confirmation email
    $subject = "Stripe Example";
    $comment = "Your payment is confirmed. Thank you for your order.";

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($email, $subject, $comment, $headers);
    ?>
</html>