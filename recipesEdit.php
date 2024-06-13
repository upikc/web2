<?php
include "api\db.php";
include "api\loginCheck.php";

$r_id = $_GET["id"];
if ($r_id){
$query = mysqli_query($link, "SELECT image , title , description from recipes where rec_id = $r_id");
$thisR = mysqli_fetch_array($query);}


$ThisUserId = $_COOKIE["userData"];
$isAdmin =  mysqli_fetch_array(mysqli_query($link, "SELECT Admin from users where user_id = $ThisUserId"))[0];
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

    <?php if ($isAdmin == 1): ?>
        <li><a id="BarL" href="Apanel.php">ADMIN</a></li>
    <?php endif; ?>
  </ul>
</nav>

  <form action="api/upload.php" method="post" enctype="multipart/form-data">

    <input hidden="true" name="ress_id" value=<?= strval($r_id)?>>

    <p><input type="text" name="name_inp" placeholder="Название" value = <?=$thisR["title"]?> ></p>
    <p><input type="text" name="descr_inp" placeholder="Описание" value = <?=$thisR["description"]?>></p>
    <input type="file" name="myFile" accept="image/*">
    <input type="submit" value="Upload">
    
    <?php $sql = "SELECT * from Ingredients";
        $result = $link->query($sql);
        while($row = $result->fetch_assoc()) 
            echo "<br> $row[Ingred_name] <input class='IngredBoxs' type='checkbox' name='IngredBox[]' value='$row[Ingred_id]'>"
    ?><br> <br> 

    <?php $sql = "SELECT * from tags";
        $result = $link->query($sql);
        while($row = $result->fetch_assoc()) 
            echo "<br> $row[tag_name] <input class='TagBoxs' type='checkbox' name='TagBox[]' value='$row[tag_id]'>"
    ?>

  </form>
    
</body>
</html>