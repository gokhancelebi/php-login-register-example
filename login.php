<?php
include "connection.php";
# login page
# check if user is logged in and redirect to index.php



# check login credentials
# if correct, redirect to index.php
# if incorrect, redirect to login.php

if(isset($_POST["username"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    #check username and password in database
    $check_user_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    #pdo user query

    if(num_rows("users",["username" => $username, "password" => $password]) > 0){
        #user found
        $_SESSION["username"] = $username;
        header("Location: index.php");

    }
    else{
        header("Location: login.php");
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
</head>
<body>

<!-- login form -->
<form action="login.php" class="login">

    <!-- username -->
    <label for="username">Username</label>
    <input type="text" name="username" id="username" placeholder="username">

    <!-- password -->
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="password">

    <!-- submit button -->
    <input type="submit" value="Login">

    <!-- register link -->
    <a href="register.php">Register</a>

</form>

</form>


</body>
</html>
