<?php
require "db.php";

$recipes = mysqli_query($link, "SELECT rec_id , title , description, creactor_id , users.name as a_name from recipes
JOIN users on recipes.creactor_id = users.user_id");
$recipes_array = mysqli_fetch_array($recipes);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php foreach($recipes as $recipe):?>

    <div style="background-color: Thistle;">
        <h2>Название: <?= $recipe["title"] ?></h2>
        <h2>Описание: <?= $recipe["description"] ?></h2>
        <h2>Автор: <?= $recipe["a_name"] ?></h2>

        <?php /*
            $author = mysqli_query($link, "SELECT name , lastname from users where user_id = $recipe[creator_id]");
            $author_array = mysqli_fetch_array($recipes);
            ?>
            <p>Автор: <?= $author_array[0] */
        ?>
    </div>
<?php endforeach;?>

</body>
</html>