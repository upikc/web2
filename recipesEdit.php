<?php
include "api\loginCheck.php";

$r_id = $_GET["id"];

echo $r_id;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>редактирование рецепта</title>
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
    
</body>
</html>