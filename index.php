<?php

include __DIR__ . "/connection.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<?php # html page ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
Thank you! You are now logged in.
</body>
</html>