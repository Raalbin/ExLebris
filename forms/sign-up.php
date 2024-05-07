<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href='css/sign-up.css'/>
    <link rel="shortcut icon" href="../icons/miniLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<?php
require_once "../php/functions.php";
//session_start();

if(isLoggedIn()):
    header('Location: main-page.php');
    ?>
<?php else: ?>
    <div class="signup-block">

        <img class = "logoImage" src="../icons/mainLogo.svg"/>
        <form class="form-signup" action="../php/registration.php" method="post">
            <?php
            require 'alert.php';
            ?>
            <h2 class="form-signup-heading">Регистрация</h2>
            <div class="control-email">
                <input type="email" class="form-control" name="username" placeholder="Введите почту" required=""/>
            </div>
            <div class="control-password">
                <input type="password" class="form-control" name="password" placeholder="Придумайте пароль"
                       required=""/>
            </div>
            <div class="confirm-password">
                <input type="password" class="form-control" name="confirm-password" placeholder="Подтвердите пароль"
                       required=""/>
            </div>

            <div>
                <p> Пароль должен состоять мимнимум из 8-ми символов.</p>
            </div>
            <div class="submit-block">
                <button type="submit" name="submit" value='send message' class="btn btn-primary">Зарегистрироваться
                </button>
            </div>
            <div class="signin-link">
                <a href="sign-in.php">Уже есть аккаунт? Войти</a>
            </div>
        </form>
    </div>
    <img class = "bookShelf" src="../icons/bookShelf.png"/>
<?php endif ?>
</body>
</html>