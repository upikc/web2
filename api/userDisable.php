<?php
require "db.php";
$u_id = $_GET["id"];
mysqli_query($link, "UPDATE users SET enable = 0 WHERE user_id = $u_id");
echo "<script> alert('аккаунт Disable');location.href='../index.php'</script>";
?>