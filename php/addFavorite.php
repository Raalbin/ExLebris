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
    $sqlBook = "INSERT INTO favorite (userID, bookID) VALUES ('$userID','$bookID')";
    $mysql->query($sqlBook);
    dbClose($mysql);
    header('Location: ../forms/book-page.php?book='.$bookID);
} else {
    echo "bEDA";
}