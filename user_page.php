<?php
require "api\db.php";

if (!$_COOKIE["userData"])
echo "<script> alert('Выдолжны зарегистрироваться');location.href='index.php';</script>";


$id = $_COOKIE["userData"];
$query = mysqli_query($link, "SELECT name , lastname , password , login from users WHERE $id = user_id");
$UserThis = mysqli_fetch_array($query);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>профиль пользователя <?=$UserThis["name"]?></title>
</head>
<body>
    
    <h2><a href="mainPage.php" >Назад</a></h2>
<!--
    <h id="text">$User</h> 

    <script>
        document.getElementById('text').textContent = 'end';
    </script>
-->

    <form id="userDataChangeForm" action="api/userDataChange.php" method="POST">
        <p><input type="text" name="login" placeholder="Логин" value = <?=$UserThis["login"]?> ></p>
        <p><input type="password" name="pass" placeholder="Пароль" value = <?=$UserThis["password"]?> /></p>
        <p><input type="text" name="name" placeholder="Имя" value = <?=$UserThis["name"]?>  ></p>
        <p><input type="text" name="lastName" placeholder="Фамилия" value = <?=$UserThis["lastname"]?> /></p>

        <button type="submit">изменить данные</button>
    </form>

</body>
</html>