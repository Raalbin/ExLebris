<?php
require_once "../classes/FileManager.php";
require_once "../classes/LibraryManager.php";
if (isset($_GET['searchingField'])) {
    $info = htmlspecialchars($_GET['searchingField']);
    $libraryManager = new LibraryManager();
    $searchResult = $libraryManager->findBook($info);
    //echo $info + PHP_EOL;
    //echo var_dump($searchResult['Id_Book']) + PHP_EOL;
    
    if(isset($searchResult)){
        header("Location: ../forms/book-page.php?book=" . $searchResult['Id_Book']);
    }else{
        header("Location: ../forms/main-page.php");
    }
    
}