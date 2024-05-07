<?php
require_once "../php/functions.php";
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

session_start();

if (!isLoggedIn()):
    header('Location: ../');
    ?>

<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../icons/miniLogo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href='css/header.css'/>
    <title>Страница книги</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        body {
            background: whitesmoke;
        }

        #cont {
            overflow-y: hidden;
            overflow-x: hidden;
            padding-left: 0;
            padding-right: 0;
        }

        .bookPage {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .fullImage {
            display: block;
            margin-right: auto;
            margin-bottom: 10px;
            max-width: max-content;
            max-height: max-content;
            padding-left: 10px;
            padding-top: 10px;
        }

        .textCol {
            padding-left: 0;
        }

        .imgCol {
            padding-right: 0;
        }

         .alert {
             width: 220px;
             margin: 0 auto;
             text-align: center;
             display: flex;
             justify-content: center;
         }
    </style>
</head>
<body>
<div id="cont" class="container-fluid">
    <?php require_once "header.php";

    require 'alert.php';


    echo '</div>';
    require_once "../classes/LibraryManager.php";
    require_once "../classes/FileManager.php";
    $libManager = new LibraryManager();
    $fileManager = new FileManager();
    $book = $libManager->getBookByID($_GET['book']);
    //$categoryName = $libManager->getCategoryByID($book['categories']);
    $categoryName = $libManager->getCategoryByID($book['Id_Category']);
    $authorName = $libManager->getAuthorByID($book['Id_Author']);
    if (isset($_GET['book']) && isset($book)) {
        if (isset($_GET['r'])) {
            echo '<div class="name-section mt-2" style="text-align: center">
            <h3>Режим чтения </h3>
        </div>';
            $textPath = $fileManager->getTextPath($book['Id_Book']);
            echo '<div class="container" style="background: white">';
            $fileManager->simpleFb2ShowParser($textPath);
            echo '</div>';
        } else {
            echo '<div class="name-section mt-2" style="text-align: center">
            <h3>Информация о книге </h3>
        </div>';
            echo ' 
        <div class="container mt-4 bookPage">

                <div class="card-deck">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4 imgCol">
                                <img class="card-img-top fullImage" src="' . $fileManager->getImagePath($book['Id_Book']) . '">
                            </div>
                            <div class="col-md-8 textCol">
                                <div class="card-body">';
            echo '<h3 class="card-title">' . $book['Name'] . '</h3>';
            echo '<p class="card-text mt-3"><b>Автор: </b> ' . $authorName['Name'] . '</p>';
            echo '<p class="card-text"><b>Жанр: </b>' . $categoryName['Name_Category'] . '</p>';
            echo '<p class="card-text"><b>Цена: </b>' . $book['Price'] . ' ₽' . '</p>';
            echo '<p class="card-text"><small class="text-muted"">' . $book['Description'] . '</small></p>';
            echo '<a class="btn btn-success p-2" href="../forms/book-page.php?book=' . $book['Id_Book'] . '&r=1"' . ' style="width:150px">Добавить в корзину</a><br/>';

            if ($libManager->checkFavorite($_SESSION['user'], $book['id'])) {
               // echo '<a class="btn btn-warning mt-2 p-2" href="../php/deleteFavorite.php?book=' . $book['id'] . '"' . ' style="width:200px">Убрать из избранного</a><br/>';
            } else {
               // echo '<a class="btn btn-success mt-2 p-2" href="../php/addFavorite.php?book=' . $book['id'] . '"' . ' style="width:200px">Добавить в корзину</a><br/>'; 

            }
            if (isAdmin($_SESSION['user']) || isModerator($_SESSION['user'])) {
                echo '<a class="btn btn-danger p-2 mt-2" href="../php/deleteBook.php?book=' . $book['id'] . '"' . ' style="width:170px">Удалить книгу</a>';
            }
            echo '</div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        ';
        }
    } else {
        header('Location: ../forms/main-page.php');
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
            crossorigin="anonymous"></script>
</body>

<?php endif ?>
</html>
