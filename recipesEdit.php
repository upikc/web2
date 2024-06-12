<?php
include "api\db.php";
include "api\loginCheck.php";

$r_id = $_GET["id"];
if ($r_id){
echo $r_id;
$query = mysqli_query($link, "SELECT image , title , description from recipes where rec_id = $r_id");
$thisR = mysqli_fetch_array($query);}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php if($r_id):?>редактирование<?php else: ?>создание рецепта<?php endif;?></title>
    <link rel="stylesheet" href="Nbar.css" />
</head>
<body>
<nav>
  <ul>
    <li><a id = "BarL" href="user_Page.php">Профиль</a></li>
    <li><a id = "BarL" href="mainPage.php">Основа</a></li>
    <li><a id = "BarL" href="recipesEdit.php" >Новый рецепт</a></li>
    <li><a id = "BarL" href="index.php" >Выйти</a></li>
  </ul>
</nav>

  <p><input type="text" name="name_inp" placeholder="Название" value = <?=$thisR["title"]?> ></p>
  <p><input type="text" name="descr_inp" placeholder="Описание" value = <?=$thisR["description"]?> /></p>
        
    
</body>
</html>