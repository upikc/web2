<?php
require "db.php";


$this_login = trim($_POST["login"]);
$password = trim($_POST["pass"]);
$name = trim($_POST["name"]);
$lastname = trim($_POST["lastName"]);

$myId = (int)$_COOKIE['userData'];

$query = mysqli_query($link, "SELECT login , password , name , lastname from users where user_id= $myId");
$user = mysqli_fetch_array($query);

if ($user["login"] ==($this_login && $user["password"] == $password) && $user["name"] == ($name) && $user["lastname"] == ($lastname))
{
    echo "<script> alert('данные эдентичны');</script>";
}
else if (empty($this_login) || empty($password) || empty($name) || empty($lastname))
{
    echo "<script> alert('заполните все поля');</script>";
}
else
{ 
    echo "<script> alert('успешная смена данных');</script>";
    mysqli_query($link, "UPDATE users SET name= '$name' , lastname= '$lastname' , login= '$this_login' , password= '$password' WHERE user_id = $myId");
}

echo "<script>location.href='../user_page.php';</script>";

?>