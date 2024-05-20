<?php
require "db.php";
include "logOut.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>вход</title>
</head>
<body>
    <form id="myForm" action="auth.php" method="POST">
        <p><input type="text" name="login" placeholder="Логин" /></p>
        <p><input type="password" name="pass" placeholder="Пароль" /></p>

        <button type="submit">войти</button>
        <button onclick="window.location.href='regForm.html';" type="button">зарегистироваться</button>
    </form>
</body>

</html>