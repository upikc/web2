<?php
require "db.php";
$login = $_POST["login"];
$password = $_POST["pass"];

if (!empty(trim($login)) && !empty(trim($password)))
    {
        $query = mysqli_query($link, "SELECT user_id from users where login='$login' and password='$password'");
        
        $array_id = mysqli_fetch_array($query);
        $userId = $array_id["user_id"];
        
        if (mysqli_num_rows($query) > 0)
        {
            setcookie("userData", $userId, time() + 3600, "/");

            echo "<script> alert('Добро пожаловать');location.href='mainPage.php'</script>";
        } 
        else 
        {   echo "<script> alert('не верные данные');location.href='index.html';</script>";}
    } 
else 
    {
        echo "<script> alert('Заполните все поля');location.href='index.html';</script>";

    }

?>