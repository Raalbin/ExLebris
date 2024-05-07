<?php
require_once "../php/db.php";
require_once "../classes/FileManager.php";
require_once "../classes/LibraryManager.php";
if (isset($_POST['submit'])) {
    session_start();
    $fileManager = new FileManager();
    $libraryManager = new LibraryManager();
    $books = $libraryManager->getBooks();
    $lastID = $books[0]['id'];
    $filePath = $fileManager->createStorage($lastID+2).'/';
    if(!$fileManager->addFile('fileImage',$filePath,1)){
        $fileManager->deleteDirectory($filePath);
        $_SESSION['flag']=-4;
        header("Location: ../forms/main-page.php");
    }
    if(!$fileManager->addFile('fileText',$filePath,0)){
        $fileManager->deleteDirectory($filePath);
        $_SESSION['flag']=-4;
        header("Location: ../forms/main-page.php");
    }

    $name = trim($_POST['name']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    if((!isset($name) || trim($name) == '')||(!isset($author) || trim($author) == '')||
        (!isset($description) || trim($description) == '')||(!isset($category) || trim($category) == '')){
        $fileManager->deleteDirectory($filePath);
        $_SESSION['flag']=-4;
        header("Location: ../forms/main-page.php");
    }else{
        $mysql = dbConnect();
        $sqlBook = "INSERT INTO books (name, authors, categories, description, storage)
 VALUES ('$name','$author','$category','$description','$filePath')";
        $sqlCat = "UPDATE category SET book_count = book_count + 1 WHERE id='$category'";
        $mysql->query($sqlBook);
        $mysql->query($sqlCat);
        dbClose($mysql);
        $_SESSION['flag']=4;
        header("Location: ../forms/main-page.php");
    }

}
?>