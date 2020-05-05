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

        <script>
            function calculteCost()
            {
                var numberOfProductA = document.getElementById('numberOfProductA').value;
                var numberOfProductB = document.getElementById('numberOfProductB').value;
                var paymentAmount;

                paymentAmount = (25 * numberOfProductA) + (50 * numberOfProductB);

                document.getElementById('paymentAmount').value = paymentAmount;
                document.getElementById('paymentDetails').value = "€" + paymentAmount;

                if (paymentAmount > 0)
                {
                    document.getElementById('paymentAmountError').style.visibility = "hidden";
                }
                else
                {
                    document.getElementById('paymentAmountError').style.visibility = "visible";
                }
            }


            function atLeastOneProductBought()
            {
                if (document.getElementById('paymentAmount').value === '0')
                {
                    document.getElementById('paymentAmountError').style.visibility = "visible";
                    return false;
                }
                else
                {
                    return true;
                }
            }
        </script>
    </head>

    <body>
        <div class="main-content">

            <form autocomplete="off" class="form-validation" id="dor_payment_form" onsubmit="return atLeastOneProductBought()" action="make_payment.php" method="post">

                <h2><img style="vertical-align: middle;height:2.5em" src="./assets/dkit.png" alt=""/> Stripe Example</h2>

                <!-- Progress Bar -->
                <ul class="progress-indicator custom-complex">
                    <li class="completed">
                        <span class="bubble"></span>
                        <i class="fa fa-check-circle"></i>
                        1. REGISTER
                    </li>
                    <li>
                        <span class="bubble"></span>
                        2. PAYMENT
                    </li>
                    <li>
                        <span class="bubble"></span>
                        3. CONFIRMATION
                    </li>
                </ul>
                <!-- End of Progress Bar -->


                
                <label for="email">Email: </label>
                <input type="email" id = "email" name = "email" required autofocus><br><br>

                
                <label for="paymentDetails">Cost: </label>
                <input type="text" id = "paymentDetails" value = "€0" tabIndex="-1" readonly><br><br>
                <input type="hidden" id="paymentAmount" name="paymentAmount" value="0">

                <input type="submit" value="Proceed to Payment">
            </form>

        </div> 
    </body>
</html>