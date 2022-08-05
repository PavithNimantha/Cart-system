<?php 
	session_start();
?>

<?php 
	include 'database_config.php';
	
	if(isset($_POST['user_name'])){

		$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$hashed_password = sha1($password);


	$query = "SELECT * FROM users
			  WHERE user_name = '{$user_name}'
			  AND password = '{$hashed_password}'
			  LIMIT 1"; //checking query for correct user name and password
			  
	$result_set = mysqli_query($conn, $query);
	
	if ($result_set){
		
		if(mysqli_num_rows($result_set) == 1){ //check user name & password
			
			$user = mysqli_fetch_assoc($result_set); //if user name and password are mathched, save those to sessions
			$_SESSION['uid'] = $user['uid'];
			header('location: index.php');
		
		}
		
		else{
			
			$errors[] = 'Invalid Email or Password';
		}
	}
	
	else{
		$errors[] = 'Databse Query Failed';
	}}

?>


<!DOCTYPE html>
<html>

<head>
  
  <title>Login</title>
  
</head>


<body >



	<div class="Login" ><h1> Login <br> <br></h1>
	
	<?php 
		if (isset($errors) && !empty($errors)) {
			
			echo '<p style="position:relative;bottom:5px;background: #DA1B1B; color: white; padding: 6px;">Invalid Email or Password</p>';
		}
	
	
	?>
  
	
    <form method="POST" action="login.php">
	  <p>Email</p> 
	  <input type="text" name="user_name" placeholder="Enter your user name"><br><br>
	  
	  <p>Password</p>
	  <input type="password" id="logPassword" name="password" placeholder="Enter your password">
	  <br>
	  <label for="toggle">Show Password</label>
	  <input type="checkbox" id="toggle" name="toggle" onclick="myFunction()"><br><br>
		
	  <button class="btn1" type="submit" name="submit">Login</button><br><br>
	
	  <a href="register.php">Create account</a><br>
	</form>
	
  
  </div>

  <script>
        function myFunction() {
            var x = document.getElementById("logPassword");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
  </script>
</body>

</html>