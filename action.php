<?php

session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

$dbConnection = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST["category"])) {
    $category_query = "SELECT * FROM categories";
    $statement = $dbConnection->prepare($category_query);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            echo "
		<li><a href='#' class='category' cid='$row->cat_id'>$row->cat_title</a></li>
		";
        }
        echo "</div>";
    }
}

if (isset($_POST["page"])) {
    $sql = "SELECT * FROM products";
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $count = $statement->rowCount();
    $pageno = ceil($count / 9);
    for ($i = 1; $i <= $pageno; $i++) {
        echo "
	<li><a href='#' page='$i' id='page'>$i</a></li>
	";
    }
}

if (isset($_POST["getProduct"])) {
    echo '<div class="row mb-1">';
    $limit = 9;
    if (isset($_POST["setPage"])) {
        $pageno = $_POST["pageNumber"];
        $start = ($pageno * $limit) - $limit;
    } else {
        $start = 0;
    }
    $product_query = "SELECT * FROM products LIMIT $start,$limit";
    $statement = $dbConnection->prepare($product_query);
    $statement->execute();
    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            echo '
<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
<div class="block-4 text-center border">
  <figure class="block-4-image">
    <a href="shop-single.php?product=' . $row->product_id . '"><img src="' . $row->product_image . '" style="width:400px;height:300px;" alt="Image placeholder" class="img-fluid"></a>
  </figure>
  <div class="block-4-text p-4">
    <h3><a href="shop-single.php?product=' . $row->product_id . '">' . $row->product_title . '</a></h3>
    <p class="mb-0">' . $row->product_title . '</p>
    <p class="text-primary font-weight-bold">€' . $row->product_price . '</p>
  </div>
</div>
</div>
		';
        }
    }
    echo '</div>';
}



if (isset($_POST["get_seleted_Category"]) || isset($_POST["search"])) {
    if (isset($_POST["get_seleted_Category"])) {
        $id = $_POST["cat_id"];
        $sql = "SELECT * FROM products WHERE product_cat = '$id'";
    } else {
        $keyword = $_POST["keyword"];
        $sql = "SELECT * FROM products WHERE product_keywords LIKE '%$keyword%'";
    }
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_OBJ);
    echo '<div class="row mb-1">';
    foreach ($result as $row) {
        echo '
<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
<div class="block-4 text-center border">
    <figure class="block-4-image">
      <a href="shop-single.php?product=' . $row->product_id . '"><img src="' . $row->product_image . '" style="width:400px;height:300px;" alt="Image placeholder" class="img-fluid"></a>
    </figure>
    <div class="block-4-text p-4">
      <h3><a href="shop-single.php?product=' . $row->product_id . '">' . $row->product_title . '</a></h3>
      <p class="mb-0">' . $row->product_title . '</p>
      <p class="text-primary font-weight-bold">€' . $row->product_price . '</p>
    </div>
  </div>
</div>
	';
    }
    echo '</div>';
}

if (isset($_POST["addToCart"])) {
    $p_id = $_POST["proId"];
    if (isset($_SESSION["uid"])) {
        $user_id = $_SESSION["uid"];
        $sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            echo "
		<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Product is already added to cart. Continue shopping!</b>
		</div>
		";
        } else {
            $sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','$user_id','1')";
            if ($dbConnection->prepare($sql)->execute()) {
                echo "
		<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Product is added to cart!</b>
		</div>
		";
            }
        }
    } else {
        $sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            echo "
		<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Product is already added to cart. Continue shopping!</b>
		</div>";
            exit();
        }
        $sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','-1','1')";
        if ($dbConnection->prepare($sql)->execute()) {
            echo "
		<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Your product is added successfully!</b>
		</div>
		";
            exit();
        }
    }
}

//Count User cart item
if (isset($_POST["count_item"])) {
    //When user is logged in then we will count number of item in cart by using user session id
    if (isset($_SESSION["uid"])) {
        $sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
    } else {
        //When user is not logged in then we will count number of item in cart by using users unique ip address
        $sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
    }
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $row) {
        echo $row->count_item;
    }
    exit();
}

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {
    if (isset($_SESSION["uid"])) {
        //When user is logged in this query will execute
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
    } else {
        //When user is not logged in this query will execute
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
    }
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    echo' 
 
        <script src="js/main.js" type="text/javascript"></script>
        <div class="row mb-5">
          <form class="col-md-12">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Quantity</th>
                    <th class="product-quantity">Price</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Action<span><br>(Delete/Update)</span></th>
                  </tr>
                </thead>
                <tbody>';
    if (isset($_POST["checkOutDetails"])) {
        if ($statement->rowCount() > 0) {
            //display user cart item with "Ready to checkout" button if user is not login
            echo "<form method='post' action='login_form.php'>";
            $n = 0;
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $row) {
                $n++;
                echo

                '<tr>
                    <td class="product-thumbnail">
                      <img src="' . $row->product_image . '" alt="Image" height="100" width="150";class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black">' . $row->product_title . '</h2>
                    </td>
                    <td>
                         
                    <input type="text" class="form-control text-center qty"  id="qty"   value="' . $row->qty . '" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1 readonly">
                    
<td>
                      
                    <input type="text" class="form-control text-center price"  id="price" pid="' . $row->product_id . '" value="' . $row->product_price . '" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" readonly>    

                    <td><div ><input type="text" class="form-control text-center total" id=total  value="' . $row->product_price . '"</div></td>
                    <td>
                    <a href="#" remove_id="' . $row->product_id . '" class="btn btn-danger remove"></a> <a href="#" update_id="' . $row->product_id . '" class="btn btn-primary update"></a>
                    </td>
                  </tr>                  
                       ';
            }


            echo '</form>
                </tbody>
              </table>
            </div>
          </form>
        </div>';
        }
    }
}


if (isset($_POST["paypalButton"])) {
    if (!isset($_SESSION["uid"])) {
        //    echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="Ready to Checkout">
        //	</form>';
    } else if (isset($_SESSION["uid"])) {
        //Paypal checkout form
        echo '
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="business" value="shoppingcart@khanstore.com">
			<input type="hidden" name="upload" value="1">';
        $x = 0;
        $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            $x++;
            echo
            '<input type="hidden" name="item_name_' . $x . '" value="' . $row->product_title . '">
			<input type="hidden" name="item_number_' . $x . '" value="' . $x . '">
			<input type="hidden" name="amount_' . $x . '" value="' . $row->product_price . '">
			<input type="hidden" name="quantity_' . $x . '" value="' . $row->qty . '">';
        }
        echo
        '<input type="hidden" name="return" value="http://localhost/project1/payment_success.php"/>
			<input type="hidden" name="notify_url" value="http://localhost/KhanStore/payment_success.php">
			<input type="hidden" name="cancel_return" value="http://localhost/KhanStore/cancel.php"/>
			<input type="hidden" name="currency_code" value="EUR"/>
			<input type="hidden" name="custom" value="' . $_SESSION["uid"] . '"/>
			<input style="width:14em;margin-top:32px;margin-left:105px;" type="image" name="submit"
			src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal Checkout"
			alt="PayPal - The safer, easier way to pay online">
			</form>';
    }
}


//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
    $remove_id = $_POST["rid"];
    if (isset($_SESSION["uid"])) {
        $sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
    } else {
        $sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
    }
    if ($dbConnection->prepare($sql)->execute()) {
        echo "<div class='alert alert-danger'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Product is removed from cart</b>
		</div>";
        exit();
    }
}

//Update Item From cart
if (isset($_POST["updateCartItem"])) {
    $update_id = $_POST["update_id"];
    $qty = $_POST["qty"];
    if (isset($_SESSION["uid"])) {
        $sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
    } else {
        $sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
    }
    if ($dbConnection->prepare($sql)->execute()) {
        echo "<div class='alert alert-info'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Product is updated</b>
		</div>";
        exit();
    }
}
?>






