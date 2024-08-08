<!DOCTYPE html>
<html>
<head>
	<title>Insert Page</title>
	<img id="coolDog" src="https://img.freepik.com/free-photo/lovely-pet-portrait-isolated_23-2149192357.jpg">
	<a href="loginQ2.php">Do you want to visit the login page?</a>
</head>

<body>
<?php
    session_start();
    $_POST=$_SESSION;

		$servername = "localhost";
		$user_name = "root";
		$pass_word= "";
        $db= "train_spotters";
		// database name => staff
		$conn =  new mysqli ($servername, $user_name, $pass_word, $db);
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
                
		}
		
		// Taking all 5 values from the form data(input)
		$username = $_POST['username_'];
		$password = password_hash($_POST['password_'], PASSWORD_DEFAULT);
	
        
		
		// Performing insert query execution
		// here our table name is registered_users
        $sql = "INSERT INTO users (Username, Password) VALUES ('$username', '$password')";
		
		if(mysqli_query($conn, $sql)){
			echo "<h3>Data stored in the database successfully!"
				. " Please browse your localhost php my admin"
				. " to view the updated data!</h3>";

			
                exit();
               
		} else{
			echo "ERROR $sql. "
				. mysqli_error($conn);
		}
		
		// Close connection
		mysqli_close($conn);
    
		?>
		
	
		
		
	</body>
</html>