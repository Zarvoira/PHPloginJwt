<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "store_db";

//// Create connection
//$con = mysqli_connect($servername, $username, $password, $db);
//
//// Check connection
//if (!$con) {
//    die("Connection failed: " . mysqli_connect_error());
//}

$useTestStripeKey = true;

if ($useTestStripeKey == true) {
    $privateStripeKey = "sk_test_BQokikJOvBiI2HlWgH4olfQ2";
    $publicStripeKey = "pk_test_6pRNASCoBOKtIshFeQd4XMUh";
} else { // live system
    $privateStripeKey = "place your private live key";
    $publicStripeKey = "place your public live key here";
}

?>