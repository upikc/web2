<?php
if (!is_null($_COOKIE["userData"]))
{  
    setcookie("userData",0,time()-3600,"/");
    echo "<script> alert('Выполнен выход из аккаунта');</script>";
}
?>