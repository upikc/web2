<?php
require "db.php";

if (!$_COOKIE["userData"])
echo "<script> alert('Выдолжны зарегистрироваться');location.href='index.html';</script>";


$id = $_COOKIE["userData"];
$User = mysqli_query($link, "SELECT name from users WHERE $id = user_id");
$UserThis = mysqli_fetch_array($User);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userPage</title>
</head>
<body>
    
    <h2><a href="mainPage.php" >Назад</a></h2>
    
    <h id="text">$User</h> 

    <script>
        document.getElementById('text').textContent = 'end';
    </script>


    <form id="userDataChangeForm" action="auth.php" method="POST">
        <p><input type="text" name="login" placeholder="Логин" /></p>
        <p><input type="password" name="pass" placeholder="Пароль" /></p>

        <button type="submit">изменить данные</button>
    </form>

</body>
</html>