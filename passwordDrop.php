<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>сброс пароля</title>
</head>
<body>
<form id="myForm" action="api\passDrop.php" method="POST">
        <p><input type="text" name="login" placeholder="Логин" /></p>
        <p><input type="text" name="mail" placeholder="Почта" /></p>

        <button type="submit">сбросить</button>
    </form>
</body>
</html>