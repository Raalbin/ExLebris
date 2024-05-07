<?php
session_start(['read_and_close' => 'true']);

require_once "../php/functions.php";
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

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
    <title>Избранное</title>
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
    </style>
</head>
<body>
<div id="cont" class="container-fluid h-100">
    <?php require_once "header.php";
    require_once "../classes/LibraryManager.php";
    require_once "../php/db.php";
    require_once "../classes/FileManager.php";
    $manager = new LibraryManager();
    $fileManager = new FileManager();
    $booksID = $manager->getAllFavoriteID($_SESSION['user']);
    if(isset($booksID)) {
        $notFinalString = "";
        foreach ($booksID as $value) {
            $notFinalString = $notFinalString . $value['bookID'] . ",";
        }
        $finalString = rtrim($notFinalString, ", ");
        $books = $manager->getFavoriteBooksByID($finalString);
        echo '<div class="name-section mt-2" style="text-align: center">
        <h3>Корзина</h3>
    </div>
    <div class="container mt-2 bookPage">
        <div class="container mt-4">
            <div class="row no-gutters h-100">
                <div class="card-deck">';
        foreach ($books as $value) {
            $categoryName = $manager->getCategoryByID($value['categories']);
            echo '<div class="card mb-3">
                                            <div class="row no-gutters">
                                                <div class="col-md-4 imgCol">
                                                    <img class="card-img-top fullImage" src="' . $fileManager->getImagePath($value['id']) . '">
                                                </div>
                                                <div class="col-md-8 textCol">
                                                    <div class="card-body">';

            echo '<h3 class="card-title">' . $value['name'] . '</h3>';
            echo '<p class="card-text mt-3"><b>Автор: </b> ' . $value['authors'] . '</p>';
            echo '<p class="card-text"><b>Жанр: </b>' . $categoryName['name'] . '</p>';
            echo '<p class="card-text"><b>Цена: </b>' . $price['Price'] . '</p>';
            echo '<p class="card-text"><small class="text-muted"">' . $value['description'] . '</small></p>';
            echo '<a class="btn btn-success" href="../forms/book-page.php?book=' . $value['id'] . '"' . ' style="width:170px">На страницу книги</a>';
            echo '                      
                                           </div>
                                        </div>
                                    </div>
                                </div>';
        }
        echo '</div>
            </div>
        </div>
    </div>

</div>';
    }else{
        echo '<div class="name-section mt-2" style="text-align: center">
        <h3>Корзина пуста</h3>
    </div>';
    }
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

<?php endif ?>
</html>