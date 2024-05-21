<?php
    $link = mysqli_connect("localhost", "root", "", "webBd", "3307");
    if ($link == null)
    {
        echo "<script> alert('Ошибка подключения к бд');</script>";
    }