<?php
require "db.php";
$userId = $_GET["id"];
mysqli_query($link, "UPDATE users SET enable= 1 WHERE user_id = $userId");