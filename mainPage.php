<?php
require "api\db.php";
include "api\loginCheck.php";


$recipes = mysqli_query($link, "SELECT rec_id , image , title , description, creactor_id , users.name as a_name from recipes JOIN users on recipes.creactor_id = users.user_id");
$recipes_array = mysqli_fetch_array($recipes);

/* ингридиенты */
$ingredients = mysqli_query($link, "SELECT Ingred_name from Ingredients");
$ingredients_array = mysqli_fetch_array($ingredients);

$ThisUserId = $_COOKIE["userData"];
/* список fave id */
$aa = mysqli_query($link, "SELECT recipe from faves where user = 1");
$fave_id_array = mysqli_fetch_array($aa);


?>


<script>
    function search(){
    var search_text = document.getElementById("search").value
    var target_ingrid = document.getElementById('sort_ingredient').value

    const nodeList = document.querySelectorAll('div > div')
    for (let i = 0; i < nodeList.length; i++) 
    {
        var text2 = nodeList[i].querySelector("#r_name").innerHTML.toLowerCase().replace("название: " , "")
        var text3 = nodeList[i].querySelector("#r_IngridsText").innerHTML.toLowerCase()
        
        var bool2 = text3.includes(target_ingrid.toLowerCase()) || target_ingrid.toLowerCase() == "all"
                        
        if (text2.includes(search_text.toLowerCase()) && bool2)
            nodeList[i].hidden = false
        else
            nodeList[i].hidden = true                
    }}
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<!-- сортировка -->
<p><input type="text" id="search" placeholder="Поиск" oninput = "search()">
</p>

<select id="sort_d" >
        <option value="По названию">По названию</option>
        <option value="По ингридиентам">По ингридиентам</option>
    </select>

<select id="sort_ingredient" > <!-- дроп даун еингридиенты -->
<option value="all">Все ингридиенты</option>
    <?php $sql = "SELECT Ingred_name from Ingredients";
        $result = $link->query($sql);
        while($row = $result->fetch_assoc()) 
            echo "<option value='$row[Ingred_name]'>$row[Ingred_name]</option>"
    ?>
</select><br>

<!-- скрипт селектор сортировки -->
<script>
    document.getElementById('sort_d').addEventListener('change', function(event) {
    console.log(event.target.value);
    });
</script>

<script>
    document.getElementById('sort_ingredient').addEventListener('change', function(event) {
    console.log(event.target.value);
    search();
    });
</script>



<div> <!-- рецепты -->
<?php foreach($recipes as $recipe): $thisRID = $recipe["rec_id"]; print(count($fave_id_array)) ?>

    <div style= "background-color: Thistle;">
    
        <?php if (in_array($recipe["rec_id"] , $fave_id_array)):?>
            <img  width="44" height="44" style="float:left;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Full_Star_Yellow.svg/langru-1024px-Full_Star_Yellow.svg.png">
        <?php else: ?>
            <img  width="44" height="44" style="float:left;" src="data\pngwing.com.png" >
        <?php endif;?>

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
            
        $thisIngridsText = mysqli_fetch_row($thisIngrids);?> <br>
        <br> <br>
        <h2 id = "r_IngridsText">Ингридиенты: <?=$thisIngridsText[0]?> </h2>
        
    </div>
<?php endforeach;?>

</div>
</body>
</html>