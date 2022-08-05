<?php 
	session_start();
?>

<?php
include 'database_config.php';
?>

<?php
if (isset($_SESSION['uid'])){ //require user login

$query = "SELECT * FROM cart WHERE uid={$_SESSION['uid']}";
$result_set_cart = mysqli_query($conn, $query);

if($result_set_cart){
    $cart=NULL; //product variable declaring
    $x=1; //products counts

    while($record_cart=mysqli_fetch_assoc($result_set_cart)){ //while loop for all cart products for selected user 
        $query = "SELECT * FROM products WHERE pid={$record_cart['pid']}"; //retrieve data from products table for selected user
        $result_set_products = mysqli_query($conn, $query);

        $record_products=mysqli_fetch_assoc($result_set_products); //create associative array for show coloumn data in selected products(selected products = selected user's product id in cart table) 
        $cart.='<h3>Product '.$x.' </h3>'; //html for output product number
        $cart.='<p>Name: '.$record_products['name'].'</p>'; //html for output product name(from product table)
        $cart.='<P>Colour: '.$record_products['colour'].'</P>'; //html for output product colour(from product table)
        $cart.='<P>Stock available: '.$record_cart['quantity'].'</P>'; //html for output product quantity(from cart table)

        $cart.='<button><a href="delete-cart.php?pid='.$record_cart['pid'].'" onclick="return confirm(\'Do you want to delete?\');">Delete</a></button> <br><br>';
        $x++;

     }
    }
}else{
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
</head>
<body>
    <a href="index.php">Home</a>
    <?php echo $cart; ?>
</body>
</html>