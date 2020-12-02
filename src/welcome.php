<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 

session_start(); 

    if(isset($_POST["logout"])){
        session_destroy();
        header("location: index.php");
    }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
    </head>
    <body>
        <div>
            <p><?php echo $_SESSION["pwd"] ?></p><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </body>
</html>
