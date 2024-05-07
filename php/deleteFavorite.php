<?php
require_once "../php/db.php";
require_once "../classes/FileManager.php";
require_once "../classes/LibraryManager.php";

if (isset($_GET['book'])) {
    session_start();
    $fileManager = new FileManager();
    $libraryManager = new LibraryManager();
    $user = getUser($_SESSION['user']);
    $userID = $user['id'];
    $bookID = $_GET['book'];
    $mysql = dbConnect();
    $sqlBook = "DELETE FROM `favorite` WHERE `userID`='$userID'AND `bookID`='$bookID'";
    $mysql->query($sqlBook);
    dbClose($mysql);
    header('Location: ../forms/book-page.php?book='.$bookID);
}