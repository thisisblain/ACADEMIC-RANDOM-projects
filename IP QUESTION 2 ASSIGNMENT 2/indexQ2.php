<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="question2.css">
    <style>
        .error{
            color: red;
        }
        
    </style>
</head>
<body>
    
  <?php
  $usernameError=$passwordError="";
  $username=$password="";
function input_data($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
  }  
if (isset($_POST['register'])) {
 
      
        //String Validation  
            if (empty($_POST["username_"])) {  
                  $usernameError= "Username is required!";  
            } else {  
                $username = input_data($_POST["username_"]);  
                    // check if name only contains letters and whitespace  
                    if (!preg_match("/^[a-zA-Z ]*$/ ",$username)) {  
                        echo "Only alphabets are allowed!";  
                    }  
            }  
            
            //Password Validation  
            if (empty($_POST["password_"])) {  
                    $passwordError= "Password is required!";  
            } else {  
                $password = input_data($_POST["password_"]);  
        
        // Validate password strength
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialCharacters = preg_match('@[^\w]@', $password);
        
                if(!$uppercase || !$lowercase || !$number || !$specialCharacters || strlen($password) < 8) {
                    $passwordError= 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        
                } 
            }
        }
            ?>
    <div class="basicForm">
        <h2>User Registration</h2><br>
    <span class = "error">&nbsp; &nbsp;* required field </span> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >   
    
        Username: <input type="text" name="username_" placeholder="Please create your username. No numbers are allowed!"  ><br>
        <span class="error">* <?php echo $usernameError; ?> </span>
        <br><br>
        Password: <input type="password" name="password_" placeholder="Please create a password. It should be at least 8 characters long and it should include one upper case letter, one number and a special character." >
        <span class="error">* <?php echo $passwordError; ?> </span> 
        <br><br>
        <input type="submit" name="register" value="Register">
    </form>
  
    </div>
    <?php  
 session_start();
 $_SESSION= $_POST;
 session_write_close();
        
    if(isset($_POST['register'])&& $usernameError == "" && $passwordError == "" ){
        header("Location: indexQ2INSERT.php");
        exit();
        
       
   }
        else {
            
    }  


?>  
</body>



</html>
</body>
</html>





 