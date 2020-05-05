<?php

include "db.php";

$dbConnection = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$var_value = $_POST['product'];

$var_value = ltrim(rtrim(filter_input(INPUT_POST, "product", FILTER_SANITIZE_NUMBER_INT)));
$product_query = "SELECT  product_price,product_image, product_id, product_title FROM products WHERE product_id = :prod_id";
$statement = $dbConnection->prepare($product_query);
$statement->bindParam(":prod_id", $var_value, PDO::PARAM_INT);
$statement->execute();
if ($statement->rowCount() > 0) {
    $result = $statement->fetch(PDO::FETCH_OBJ);
    echo json_encode($result);
}
