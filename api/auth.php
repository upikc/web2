<?php
require "db.php";
$login = $_POST["login"];
$password = $_POST["pass"];

if (!empty(trim($login)) && !empty(trim($password)))
    {
        $query = mysqli_query($link, "SELECT user_id , enable from users where login='$login' and password='$password'");
        
        $arrayOF_id_enable = mysqli_fetch_array($query);
        $userId = $arrayOF_id_enable["user_id"];
        
        
        if ($arrayOF_id_enable["enable"] == 0 && mysqli_num_rows($query) > 0)
        {
            echo "<script> alert('вашш аккаунт Disable!');location.href='../index.php';</script>";
            return;
        }
        if (mysqli_num_rows($query) > 0)
        {
            setcookie("userData", $userId, time() + 3600, "/");

            echo "<script> alert('Добро пожаловать');location.href='../mainPage.php'</script>";
        } // проверка на enable
        else 
        {   echo "<script> alert('не верные данные');location.href='../index.php';</script>";}
        
    } 
else 
    {
        echo "<script> alert('Заполните все поля');location.href='../index.php';</script>";

    }

?>