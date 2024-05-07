<?php
session_start();

require_once "../php/db.php";
require_once "../classes/FileManager.php";
require_once "../classes/LibraryManager.php";

if (isset($_POST['submit'])) {
    $mysql = dbConnect();
    $info = trim($_POST['user']);
    $user = getUser($info);
    if (isset($user)) {
        $_SESSION['flag'] = 4;
        $userID = $user['id'];
        $sqlModer = "UPDATE users SET `level` = 1 WHERE id='$userID'";
        $mysql->query($sqlModer);
        dbclose($mysql);
        header('Location: ../admin/admin-panel.php');
    } else {
        $_SESSION['flag'] = -4;
        header('Location: ../admin/admin-panel.php');
    }
}
