<?php

require_once "../php/db.php";
require_once "../classes/FileManager.php";
require_once "../classes/LibraryManager.php";

if (isset($_GET['book'])) {
    $mysql = dbConnect();
    $fileManager = new FileManager();
    $libraryManager = new LibraryManager();
    $book = $libraryManager->getBookByID($_GET['book']);
    $category = $libraryManager->getCategoryByID($book['categories']);
    $categoryID = $category['id'];
    $categoryCheck = $libraryManager->getCategoryByID($categoryID);
    if(($categoryCheck['book_count']-1)>0){
        $fileManager->deleteDirectory($book['storage']);
        $sqlCat = "UPDATE category SET book_count = book_count - 1 WHERE id='$categoryID'";
        $libraryManager->deleteBook($book['id']);
        $mysql->query($sqlCat);
        dbClose($mysql);
        header('Location: ../forms/main-page.php');
    }else{
        echo "Админ, у нас проблемы...";
    }

} else {
    echo "Админ, у нас проблемы...";
}