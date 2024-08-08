<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="question2.css">
</head>
<body>
    <h2>User Login Page</h2>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Login"> <a href="indexQ2.php">Don't have an account?</a>
    </form>
    <?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $servername = "localhost";
		$user_name = "root";
		$pass_word= "";
        $db= "train_spotters";
		// database name => staff
	

    // Perform database query to retrieve user data
    $conn =  new mysqli ($servername, $user_name, $pass_word, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT ID, Username, Password FROM users WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error in SQL query: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Check if the 'password' key exists in the $row array
        if (isset($row['Password']) && password_verify($password, $row['Password'])) {
            // Start a session and set user data
            session_start();
            $_SESSION['user_id'] = $row['ID'];
            $_SESSION['Username'] = $row['Username'];
            header("Location: dashboard.php"); // Redirect to user dashboard
            exit; // Terminate script execution after redirection
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    $conn->close();
}
?>
</body>
</html>