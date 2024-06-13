<?php
require "db.php";

if($file = $_FILES['myFile']) {

    $path = '../data/';
    $fileExt = end(explode('.', $file['name']));
    $fileName = uniqid('image_') . "." . $fileExt;

    $userId = intval($_COOKIE["userData"]);

    $name = $_POST['name_inp'];
    $descr = $_POST['descr_inp'];
    $res_id = (int)$_POST['ress_id'];

    $IngredCheckboxes = $_POST['IngredBox'] ?? [];
    $TagCheckboxes = $_POST['TagBox'] ?? [];


    try {


        mysqli_query($link, "DELETE FROM recipe_tags WHERE r_id = $res_id");
        mysqli_query($link, "DELETE FROM recipe_Ingred WHERE r_id = $res_id");

        foreach ($IngredCheckboxes as $checkbox) {
            $query = mysqli_query($link, "INSERT INTO recipe_Ingred (r_id, Ingred_id) VALUES ('$res_id','$checkbox')");
            echo "$checkbox";
        }
        foreach ($TagCheckboxes as $checkbox) {
            $query = mysqli_query($link, "INSERT INTO recipe_tags (r_id, tag_id) VALUES ('$res_id','$checkbox')");
            echo "$checkbox";
        }

        move_uploaded_file($file['tmp_name'], $path.$fileName);

        if ($res_id == null)//htlfrnbhjdfybt
            $query = mysqli_query($link, "INSERT INTO recipes (title,description,creactor_id,image) VALUES ('$name','$descr','$userId','$fileName')");
        else //редактирование
        {
            if ($fileExt != null)
            $query = mysqli_query($link, "UPDATE recipes SET title = '$name' , description = '$descr' , image = '$fileName' WHERE rec_id = $res_id");
            else
            $query = mysqli_query($link, "UPDATE recipes SET title = '$name' , description = '$descr' WHERE rec_id = $res_id");
        }


        echo "<script>alert('Успешно');location.href='../mainPage.php'</script>";
    
    }
    catch (Exception $e) {

        echo $e->getMessage();

    }

}