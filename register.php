<?php
# register page
# register if form is submitted
if (isset($_POST["username"])) {
    # get form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];

    # check if username is already taken
    $is_exists_user = num_rows("users", ["username" => $username]);
    $is_exists_email = num_rows("users", ["email" => $email]);
    if ($is_exists_user > 0 || $is_exists_email > 0) {
        $error = "Username or email is already taken";
    } else {
        # insert user to database
        $user_id = db_insert("users", ["username" => $username, "password" => $password, "email" => $email, "firstname" => $firstname, "lastname" => $lastname]);
        if ($user_id) {
            # login user
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            # redirect to home page
            header("Location: index.php");
            exit();
        } else {
            $error = "Something went wrong";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<form action="register.php" class="register">

    <!--- register form --->
    <h1>Register</h1>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password2" placeholder="Confirm Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="submit" name="register" value="Register">
    <p>Already have an account? <a href="login.php">Login</a></p>


</form>


</form>

</body>
</html>
