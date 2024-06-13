<?php
require "api\db.php";
include "api\loginCheck.php";

$id = $_COOKIE["userData"];
$isAdmin =  mysqli_fetch_array(mysqli_query($link, "SELECT Admin from users where user_id = $id"))[0];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Nbar.css" />
    <title>adminPanel</title>
</head>
<body>
<nav>
  <ul>
    <li><a id = "BarL" href="user_Page.php">Профиль</a></li>
    <li><a id = "BarL" href="mainPage.php">Основа</a></li>
    <li><a id = "BarL" href="recipesEdit.php" >Новый рецепт</a></li>
    <li><a id = "BarL" href="index.php" >Выйти</a></li>
    <?php if ($isAdmin == 1): ?>
        <li><a id="BarL" href="Apanel.php">ADMIN</a></li>
    <?php else:?>
        echo "<script> alert('Вкладка доступна только администратору');location.href='index.php';</script>";
    <?php endif;?>
  </ul>
</nav>




разблокирование аккаунта :
<select id="disableUsers" > <!-- дроп даун забаненых -->
    <?php $sql = "SELECT * from users where enable = 0";
        $result1 = $link->query($sql);
        while($row = $result1->fetch_assoc()) 
            echo "<option value='$row[user_id]'> логин: $row[login] пароль: $row[password] почта: $row[mail]</option>"
    ?>
</select>

<button type="button" onclick="unlock(document.getElementById('disableUsers').value)">Разблокировать аккаунт</button><br><br>


разблокирование аккаунта :
<select id="enableUsers" > <!-- дроп даун не забаненых -->
    <?php $sql = "SELECT * from users where enable = 1 and Admin != 1";
        $result2 = $link->query($sql);
        while($row = $result2->fetch_assoc()) 
            echo "<option value='$row[user_id]'> логин: $row[login] пароль: $row[password] почта: $row[mail]</option>"
    ?>
</select>

<button type="button" onclick="lockUser(document.getElementById('enableUsers').value)">Заблокировать аккаунт</button><br>




</body>
</html>


<script>

    function unlock(UserId) {
        
        fetch(`api/unlockUser.php?id=${UserId}`);
        alert("Аккаунт разблокирован!");
        location.reload()
    }

    function lockUser(UserId) {
        
        fetch(`api/lockUser.php?id=${UserId}`);
        alert("Аккаунт заблокирован!");
        location.reload()
    }
</script>
