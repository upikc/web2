<?php
require "db.php";


$this_login = $_POST["login"];
$password = $_POST["pass"];
$name = $_POST["name"];
$lastname = $_POST["lastname"];


$query = mysqli_query($link, "SELECT user_id from users where login='$this_login'");


if (empty(trim($this_login)) || empty(trim($password)) || empty(trim($name)) || empty(trim($lastname)))
{ echo "<script> alert('заполните все поля');</script>";}


else if (mysqli_num_rows($query) > 0)
{ echo "<script> alert('логин занят');</script>";}


else
{ 
    $query = mysqli_query($link, "INSERT INTO users (name,lastname,password,login) VALUES ('$name','$password','$this_login','$lastname')");

    echo "<script> alert('успешная регистрация');location.href='../index.php';</script>";
}

?>