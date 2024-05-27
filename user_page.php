<?php
require "api\db.php";
include "api\loginCheck.php";

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
    <link rel="stylesheet" href="Nbar.css" />
</head>
<body>
<nav>
  <ul>
    <li><a id = "BarL" href="user_Page.php">Профиль</a></li>
    <li><a id = "BarL" href="mainPage.php">Основа</a></li>
    <li><a id = "BarL" href="index.php" >Выйти</a></li>
  </ul>
</nav>
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
        <p><input type="password" name="oldPassword" placeholder="Введите пароль" /></p>

        <button type="submit">изменить данные</button>
    </form>

    <form >
        <button type="button" onclick="checkPasswordForDisable();" >Заблокировать аккаунт</button>
    </form>

    <script>
        function checkPasswordForDisable() {
            let pass = prompt('введите пароль');
            if (pass == <?=$UserThis["password"]?>)
                location.href = "api/userDisable.php?id=<?=$id?>"
            else
            alert('пароли не совпали');
        }
    </script>

</body>
</html>