<?php 
	session_start();
?>

<?php
include 'database_config.php';
?>

<?php
if (isset($_SESSION['uid'])){ //require user login

if(isset($_POST['submit'])){
    
    $name=$_POST['name']; //save input values for SQL query
    $colour=$_POST['colour'];
    $quan=$_POST['quan'];

    $query ="INSERT INTO products (uid,name,colour,quantity) VALUES('{$_SESSION['uid']}','$name','$colour','$quan')"; //insert values to products table
    $result_set = mysqli_query($conn, $query);

    // $_SESSION['name']=$name; //save input values to sessions for use in products page
    // $_SESSION['colour']=$colour;
    // $_SESSION['quan']=$quan;

    // echo $_SESSION['name'];
}
}else{
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Products</title>
</head>
<body>
    <a href="index.php">Home</a>
    <h1>Add New Product</h1>

    <form action="add-product.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name"><br><br>

        <label for="colour">Colour:</label>
        <input type="text" name="colour"><br><br>

        <label for="quan">Quantity:</label>
        <input type="number" name="quan" value="1"><br><br>

        <button type="submit" name="submit">Add Product</button>
    </form>
</body>
</html>