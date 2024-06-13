<?php
require "db.php";


$this_login = $_POST["login"];
$password = $_POST["pass"];
$name = $_POST["name"];
$lastname = $_POST["lastname"];
$mail = $_POST["mail"];


$query = mysqli_query($link, "SELECT user_id from users where login='$this_login' OR mail='$mail' ");


if (empty(trim($this_login)) || empty(trim($password)) || empty(trim($name)) || empty(trim($lastname)))
{ echo "<script> alert('заполните все поля');location.href='../regForm.html';</script>";}


else if (mysqli_num_rows($query) > 0)
{ echo "<script> alert('логин или почта заняты');location.href='../regForm.html';</script>";}


else
{ 
    $query = mysqli_query($link, "INSERT INTO users (name,lastname,password,login,mail) VALUES ('$name','$password','$this_login','$lastname','$mail')");

    echo "<script> alert('успешная регистрация');location.href='../index.php';</script>";
}

?>