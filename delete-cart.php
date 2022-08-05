<?php 
	session_start();
?>

<?php
include 'database_config.php';
?>

<?php
if (isset($_SESSION['uid'])){ //require user login

if (isset($_GET['pid'])){ //get product id
        $product_id = mysqli_real_escape_string($conn, $_GET['pid']); //sanitize

        $query = "DELETE FROM cart WHERE uid = {$_SESSION['uid']} AND pid = {$product_id}"; //delete query
        $result = mysqli_query($conn, $query);

}

        if ($result) {
            // product deleted
            header('Location: cart.php');
        } else {
            header('Location: cart.php?cart_deleted=false');
        }

    }else{
        header('location: login.php');
    }
?>