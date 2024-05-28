<?php
require "db.php";
$r_id = $_GET["id"];
$u_id = $_GET["uid"];
// поиск faves
$aa = mysqli_query($link, "SELECT * FROM faves WHERE user='$u_id' AND recipe='$r_id' ");
$aa_rsp = mysqli_fetch_assoc($aa);
$faves_id = $aa_rsp['faves_id'];
// проверка существование faves
if (!$faves_id)
    mysqli_query($link, "INSERT INTO faves (user,recipe) VALUES ('$u_id','$r_id')");
else
    mysqli_query($link, "DELETE from faves WHERE faves_id='$faves_id'");

?>
