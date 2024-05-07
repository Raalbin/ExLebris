<?php
require_once "../php/db.php";
require_once "../classes/FileManager.php";
require_once "../classes/LibraryManager.php";

session_start();

if (isset($_POST['submit'])) {
    session_start();
    $mysql = dbConnect();
    $info = trim($_POST['user']);
    $user = getUser($info);
    if(isset($user)){
        if($user['level']!=2) {
            $userID = $user['id'];
            $sqlUser = "DELETE FROM `users` WHERE `id`='$userID'";
            $sqlFavor = "DELETE FROM `favorite` WHERE `userID`='$userID'";
            $mysql->query($sqlUser);
            $mysql->query($sqlFavor);
            dbclose($mysql);
            $_SESSION['flag'] = 4;
            header('Location: ../admin/admin-panel.php');
        }else{
            $_SESSION['flag'] = -4;
            header('Location: ../admin/admin-panel.php');
        }
    }else{
        $_SESSION['flag'] = -4;
        header('Location: ../admin/admin-panel.php');
    }
}
