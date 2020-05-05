<?php
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
                    <li>
                        <span class="bubble"></span>
                        3. CONFIRMATION
                    </li>
                </ul>
                <!-- End of Progress Bar -->

                <label>Email: </label>
                <input type="text" value = "<?php echo $email ?>" tabIndex="-1" readonly><br><br>

                <label>Number Of Product A: </label>
                <input type="text" value = "<?php echo $numberOfProductA ?>" tabIndex="-1" readonly><br><br>

                <label>Number Of Product B: </label>
                <input type="text" id="numberOfProductB"  value = "<?php echo $numberOfProductB ?>" tabIndex="-1" readonly><br><br>

                <label>Cost: </label>
                <input type="text" value = "€<?php echo $paymentAmount ?>" tabIndex="-1" readonly><br><br>
            </form>


            <form  action="payment_confirmation.php" style="text-align: center" method="post">
                <input type="hidden" name = "email" value = "<?php echo $email ?>">
                <input type="hidden" name = "paymentAmount" value = "<?php echo $paymentAmount ?>">

<?php require_once 'configuration.php'; ?>
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"    

                    data-key="<?php echo $publicStripeKey ?>"
                    data-email= "<?php echo $email ?>"
                    data-currency="EUR"
                    data-amount="<?php echo $paymentAmount . '00' ?>"
                    data-name="The Company Name"
                    data-description="Stripe Sales Example"
                    data-image="./assets/dkit.png"
                    data-locale="auto">
                </script>

            </form>
            <form style="text-align: center">
                <button type="button" class ="cancel_button" onclick = "window.history.back()"><span>Change Details</span></button>
            </form><br>

        </div> 
    </body>
</html>