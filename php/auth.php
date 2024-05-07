<?php
require_once "functions.php";
if (isset($_POST['submit'])) {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);
    session_start();
    if (checkUser($user, $pass)) {
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $pass;
        header('Location: ../forms/main-page.php');
    } else {
        $_SESSION['flag'] = -2;
        header('Location: ../forms/sign-in.php');
    }
} else {
    echo "Вход не сработал";
}

