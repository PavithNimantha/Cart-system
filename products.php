<?php 
	session_start();
?>

<?php
include 'database_config.php';
?>

<?php
if (isset($_SESSION['uid'])){ //require user login

$query = "SELECT * FROM products";
$result_set = mysqli_query($conn, $query);

if($result_set){

    $products=NULL; //product variable declaring
    $x=1; //products counts

    while ($record = mysqli_fetch_assoc($result_set)){ //looping for show all products of products in SQL database
            
            $products.='<h3>Product '.$x.' </h3>'; //html for output products
            $products.='<p>Name: '.$record['name'].'</p>';
            $products.='<P>Colour: '.$record['colour'].'</P>';
            $products.='<P>Stock available: '.$record['quantity'].'</P>';
            $products.='<form action="products.php" method="POST">';
            $products.='<input type="hidden" name="pid" value="1">';

            $products.='<label for="quan">Quantity:</label>';
            $products.='<input type="number" name="quan" value="1">';

            $products.='<button type=submit name="submit">Add to Cart</button>';
            $products.='</form><br><br>';
            $x++;
    }



if(isset($_POST['submit'])){

    $pid=$_POST['pid']; //save input product id for SQL query
    $quan=$_POST['quan']; //save input quantity for SQL query

    $query = "SELECT * FROM cart WHERE uid={$_SESSION['uid']} AND pid=$pid"; //check same user id and product id row already inserted
    $result_set = mysqli_query($conn, $query);

    if(mysqli_num_rows($result_set) == 1){

        $query="UPDATE cart SET quantity=$quan WHERE pid=$pid AND uid={$_SESSION['uid']}"; //if same pid and uid row already available, update the quantity only
        $result_set = mysqli_query($conn, $query);
    
    } else{

        $query ="INSERT INTO cart (pid,quantity,uid) VALUES('$pid','$quan','{$_SESSION['uid']}')"; //if same pid and uid row not available, insert all data fresh(uid,pid,quantity)
        $result_set = mysqli_query($conn, $query);
    }
}
}
}else{
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
</head>
<body>
<a href="index.php">Home</a>

<?php
    echo $products;
?>
</body>
</html>