<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shoppers</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
        <link rel="stylesheet" href="fonts/icomoon/style.css">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/jquery2.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="main.js" type="text/javascript"></script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href="css/progress-wizard.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/progress_bar.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <div class="site-wrap">
            <header class="site-navbar" role="banner">
                <div class="site-navbar-top">
                    <div class="container">
                        <div class="row align-items-center">

                            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                                
                            </div>

                            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                                <div class="site-logo">
                                    <a href="index.php" class="js-logo-clone">Shoppers</a>
                                </div>
                            </div>

                            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                                <div class="site-top-icons">
                                    <ul>
                                        <li>
                                            <a href="cart.php" class="site-cart">
                                                <span class="icon icon-shopping_cart"></span>
                                                <span class="count">0</span>
                                            </a>
                                        </li> 
                                        <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                                    </ul>
                                </div> 
                            </div>

                        </div>
                    </div>
                </div> 
                <nav class="site-navigation text-right text-md-center" role="navigation">
                    <div class="container">
                        <ul class="site-menu js-clone-nav d-none d-md-block">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="shop.php">Shop</a></li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="bg-light py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.php">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
                    </div>
                </div>
            </div>

            <div class="site-section">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <!-- Progress Bar -->
                            <ul id="progress_ul" class="progress-indicator custom-complex">
                                <li class="progress_li completed">
                                    <span class="bubble"></span>
                                    <i class="fa fa-check-circle"></i>
                                    BILLING & ORDER DETAILS
                                </li>
                                <li class="progress_li">
                                    <span class="bubble"></span>
                                    PAYMENT CONFIRMATION
                                </li>
                            </ul>
                            <!-- End of Progress Bar -->

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5 mb-md-0">
                            <h2 class="h3 mb-3 text-black">Billing Details</h2>
                            <div class="p-3 p-lg-5 border">
                                <div class="form-group">
                                    <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                                    <select id="c_country" class="form-control">
                                        <option value="1">Select a country</option>    
                                        <option value="2">Ireland</option>    
                                        <option value="3">UK</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_fname" name="c_fname">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_lname" name="c_lname">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                                    </div>
                                </div>

                                <div class="form-group row mb-5">
                                    <div class="col-md-6">
                                        <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_email_address" name="c_email_address">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <h2 class="h3 mb-3 text-black">Your Order</h2>
                                    <div class="p-3 p-lg-5 border">
                                        <table class="table site-block-order-table mb-5">
                                            <tbody>
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                                    <td class="text-black font-weight-bold"><span class="text-black">€</span><strong class="text-black net_total" value=""  id="net_total"></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        <!--                                        <div class="form-group">
                                                                                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location = 'thankyou.html'">Place Order</button>
                                                                                </div>-->

                                        <?php include 'db.php'; ?>
                                        <form action="thankyou.php" style="text-align: center" method="post">
                                            <script
                                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"    

                                                data-key="<?php echo $publicStripeKey ?>"
                                                data-currency="EUR"
                                                data-amount=""
                                                data-description="Shoppers"
                                                data-locale="auto">
                                            </script>
                                        </form>
                                        
                                        <div id="paypal"> </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>

            <footer class="site-footer border-top">
                <div class="container">

                    <div class="row pt-5 mt-5 text-center">
                        <div class="col-md-12">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>

                    </div>
                </div>
            </footer>
        </div>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/main.js"></script>


        <div style="display:none;">
            <div id="cart_checkout"> </div>
        </div>

    </body>
</html>