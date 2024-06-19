<?php
require "db.php";
$login = $_POST["login"];
$sendMail = $_POST["mail"];

if (!empty(trim($login)) && !empty(trim($sendMail)))
    {
        $query = mysqli_query($link, "SELECT user_id , enable from users where login='$login' and mail ='$sendMail'");
        
        $arrayOF_id_enable = mysqli_fetch_array($query);
        $userId = $arrayOF_id_enable["user_id"];
        
        
        if ($arrayOF_id_enable["enable"] == 1 && mysqli_num_rows($query) > 0) //сброс пароля
        {

            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $newPassword = '';
            for ($i = 0; $i < 10; $i++) {
                $newPassword .= $characters[mt_rand(0, strlen($characters) - 1)];
            }


            mysqli_query($link, "UPDATE users SET password = '$newPassword' WHERE user_id = '$userId'");
    
            $to = $sendMail;
            $subject = "Новый пароль";
            $message = "Ваш новй пароль: $newPassword для аккаунта $login";
            mail($to, $subject, $message);




            echo "<script> alert('Новый пароль отправлен на почту!');location.href='../passwordDrop.php';</script>";
            return;
        }
        if (mysqli_num_rows($query) > 0)
        {
            echo "<script> alert('Ваш аккаунт заблокирован');location.href='../passwordDrop.php'</script>";
        }
        else 
        {   echo "<script> alert('не верные данные');location.href='../passwordDrop.php';</script>";}
        
    } 
else 
    {
        echo "<script> alert('Заполните все поля');location.href='../passwordDrop.php';</script>";

    }

?>