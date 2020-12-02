<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start() ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
	$pwdErr = "";
	$pattern = "/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
        $valid = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty($_POST["pwd"])){
			$pwdErr = "Please enter a password";
                        $valid = false;
		}else{
                    // check password length
                    if(strlen($_POST["pwd"]) < 8 ){
                            $pwdErr = "Password must be at least 8 characters in length";
                            $valid = false;
                    }
                    
                    // check if password meets the complexity requirement
                    if (preg_match($pattern, $password) == 1){
                            $pwdErr = "Password does not meet requirements";
                            $valid = false;
                    }
                    
                    // block if password is common
                    $fn = fopen("10-million-password-list-top-100.txt", "r");
                    while(! feof($fn)){
                        $result = fgets($fn);
                        if($result == $_POST["pwd"]){
                            $pwdErr = "Common passwords are not allowed";
                            $valid = false;
                        }
                    }
		}
                
                // if password valid, redirect to welcome.php
                if($valid){
                    $_SESSION["pwd"] = $_POST["pwd"];
                    header("location: welcome.php");
                }
		
	}
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="pwd">Password:</label><br>
		<input type="password" id="pwd" name="pwd"><br>
		<input type="submit" name="submit" value="Submit">
	</form>
    </body>
</html>
