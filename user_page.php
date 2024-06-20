<?php
require "api\db.php";
include "api\loginCheck.php";

$id = $_COOKIE["userData"];
$query = mysqli_query($link, "SELECT name , lastname , password , login from users WHERE user_id = $id");
$UserThis = mysqli_fetch_array($query);


$isAdmin =  mysqli_fetch_array(mysqli_query($link, "SELECT Admin from users where user_id = $id"))[0];
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
    <li><a id = "BarL" href="recipesEdit.php" >Новый рецепт</a></li>
    <li><a id = "BarL" href="index.php" >Выйти</a></li>
    <?php if ($isAdmin == 1): ?>
        <li><a id="BarL" href="Apanel.php">ADMIN</a></li>
    <?php endif; ?>
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

    <p>
    
        <button type="button" onclick="checkPasswordForDisable();" >Заблокировать аккаунт</button>
    



    <!-- РЕЦЕПТЫ -->
    <?php $recipes = mysqli_query($link, "SELECT rec_id , image , title , description, creactor_id , users.name as a_name , faves.user from recipes JOIN users on recipes.creactor_id = users.user_id JOIN faves on recipes.rec_id = faves.recipe where faves.user = '$id'");
    foreach($recipes as $recipe): $thisRID = $recipe["rec_id"]; ?>

    <div style= "background-color: Thistle;">
    
        <h2 id = "r_name" >Название: <?= $recipe["title"] ?> || Описание: <?= $recipe["description"] ?></h2>
        <h2>Автор: <?= $recipe["a_name"]?>   

        <!-- проверка для добавления кнопки -->
        <?php if ($recipe["creactor_id"] == $_COOKIE["userData"]): ?>
            <button type="button" onclick='location.href = "recipesEdit.php?id=<?=$thisRID?>"'>отредактироваться</button>
        <?php endif;?></h2>
        
        <img style="float:left;" src="data/<?= $recipe["image"]?>" height="90">

        <?php  $thisIngrids = mysqli_query($link, "SELECT GROUP_CONCAT(Ingredients.Ingred_name) FROM recipe_Ingred
            join Ingredients on recipe_Ingred.Ingred_id = Ingredients.Ingred_id
            where recipe_Ingred.r_id = $thisRID
            ");

            $thistTags = mysqli_query($link, "SELECT GROUP_CONCAT(tags.tag_name) FROM recipe_tags
            join tags on recipe_tags.tag_id = tags.tag_id
            where recipe_tags.r_id = $thisRID
            ");
            
        $thisIngridsText = mysqli_fetch_row($thisIngrids); 
        $thisTagsText = mysqli_fetch_row($thistTags);?> <br>
        <br> <br> <br>
        <h2 id = "r_IngridsText">Ингридиенты: <?=$thisIngridsText[0]?>
        <h2 id = "r_TagText">Теги: <?=$thisTagsText[0]?> </h2>
        
    </div>
<?php endforeach;?>

    <script>
        function checkPasswordForDisable() {
            let pass = prompt('введите пароль');
            if (pass == '<?=$UserThis["password"]?>')
                location.href = "api/userDisable.php?id=<?=$id?>"
            else
            alert('пароли не совпали');
        }
    </script>

</body>
</html>