<?php 
	session_start();
?>


<?php 
include 'database_config.php';
?>

<?php
if(isset($_POST['user_name'])){
$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$hashed_password = sha1($password);

$Check_username_indb_query = "SELECT * FROM users WHERE user_name = '{$user_name}'"; //check the user_name for duplicate
$result_check = mysqli_query($conn,$Check_username_indb_query);
if(mysqli_num_rows($result_check)==1)
{
  $errors[] = "Registration failed, this user name is already taken";
}
else{

    $query ="INSERT INTO users (user_name,password)
    VALUES('$user_name','$hashed_password')"; //insert data to the database

    $result_set = mysqli_query($conn, $query);

    $query2 = "SELECT * FROM users
			  WHERE user_name = '{$user_name}'
			  AND password = '{$hashed_password}'
			  LIMIT 1"; //for save details to sessions

			$result_set = mysqli_query($conn, $query2);

			$user = mysqli_fetch_assoc($result_set);

            $_SESSION['uid'] = $user['uid'];

            header('location: index.php');
}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
  </head>

  <body>
  
          <form action="register.php" method="POST" >
            <h3 class="title">Register</h3>

            <div class="input-container">
              <input type="text" name="user_name" required>
              <label for="user_name">user_name</label>   
            </div>

            <?php 
		            if (isset($errors) && !empty($errors)) {
			
			              echo '<p style="position:relative;bottom:14px;font-size:17px; color:red; padding: 2px;">This User Name Is Alredy Exist</p>';
		            }
              ?>
              
            </div>
            <input type="password" id="logPassword" name="password" class="input" required>
              <label for="password">Password</label>
            </div>

            <div>
              <label for="toggle">Show Password</label>
	            <input type="checkbox" id="toggle" name="toggle" onclick="myFunction()">
            </div>
            
            <br>
            
            <input type="submit" value="Sign up">
          </form>
        </div>
      </div>
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