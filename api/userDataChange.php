<?php
require "db.php";


$this_login = trim($_POST["login"]);
$password = trim($_POST["pass"]);
$name = trim($_POST["name"]);
$lastname = trim($_POST["lastName"]);

$myId = (int)$_COOKIE['userData'];

$query = mysqli_query($link, "SELECT login , password , name , lastname from users where user_id= $myId");
$user = mysqli_fetch_array($query);
if ($user["login"] == (trim($this_login)) && $user["password"] == (trim($password)) && $user["name"] == (trim($name)) && $user["lastname"] == (trim($lastname)))
{
    echo "<script> alert('данные эдентичны');</script>";

}
else if (empty(trim($this_login)) || empty(trim($password)) || empty(trim($name)) || empty(trim($lastname)))
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