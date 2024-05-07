<?php
require_once'functions.php';
if (isset($_POST['submit'])) {
    session_start();
    $_SESSION['flag'] = 0;
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);
    $confirmPass = trim($_POST['confirm-password']);
    if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flag'] = -5;
        header('Location: ../forms/sign-up.php');
        exit();
    }else if(strlen($pass)<=7){
        $_SESSION['flag'] = -6;
        header('Location: ../forms/sign-up.php');
        exit();
    }
    //Проверка на занятый email.
    if (isUserExist($user)) {
        $_SESSION['flag'] = -3;
        header('Location: ../forms/sign-up.php');
        exit();
    } else {
        //Проверка на равенство паролей.
        if ($pass == $confirmPass) {
            $pass = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            //Если запрос выполнился успешно, проходим дальше на страницу авторизации.
            if (regUser($user,$pass)) {
                $_SESSION['flag'] = 1;
                header('Location: ../forms/sign-in.php');
                exit();
            }else{
                echo "Что-то пошло не так";
            }
        } else {
            $_SESSION['flag'] = -1;
            header('Location: ../forms/sign-up.php');
            exit();
        }
    }

}

