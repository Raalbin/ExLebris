<?php
require_once "php/functions.php";
session_start();
if (!isLoggedIn()) {
    $_SESSION['count'] = 0;
    $_SESSION['flag'] = 0;
    header('Location: forms/sign-in.php');
} else {
    header('Location: forms/main-page.php');
}


