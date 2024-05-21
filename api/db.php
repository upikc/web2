<?php
    $link = mysqli_connect("localhost", "root", "1234", "webBd", "3307");
    if ($link == null)
    {
        echo "<script> alert('Ошибка подключения к бд');</script>";
    }