<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" type="text/css" href='css/sign-in.css'/>
    <link rel="shortcut icon" href="../icons/miniLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"
</head>

<?php
require_once "../php/functions.php";
if(isLoggedIn()):
        header('Location: main-page.php');
?>
<?php else:?>
<body>
    <div class="signin-block">
        <img class = "logoImage" src="../icons/mainLogo.svg"/>
        <form class="form-signin" action="../php/auth.php" method="post">
            <?php
            require 'alert.php';
            ?>
            <h2 class="form-signin-heading">Вход</h2>
            <div class="control-email">
                <input type="email" class="form-control" name="username" placeholder="Электронная почта" required=""/>
            </div>
            <div class="control-password">
                <input type="password" class="form-control" name="password" placeholder="Пароль" required=""/>
            </div>
            <div class="submit-block">
                <button type="submit" name="submit" value='send message' class="btn btn-primary">Войти
                </button>
            </div>
            <div class="signin-link">
                <a href="sign-up.php">Нет аккаунта? Зарегистрируйтесь</a>
            </div>
        </form>
    </div>
    <img class = "bookShelf" src="../icons/bookShelf.png"/>
</body>
<?php endif?>
</html>