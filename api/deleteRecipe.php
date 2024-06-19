<?php
require "db.php";
$r_id = $_GET["id"];
mysqli_query($link, "DELETE FROM recipes WHERE rec_id = $r_id");

echo "alert('рецепт удален'); <script>location.href='../mainPage.php';</script>";
?>
