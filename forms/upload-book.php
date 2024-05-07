<?php
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
    <title>Высшие привилегии</title>
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
    </style>
</head>
<body>
<div id="cont" class="container-fluid h-100">
    <?php require "header.php" ?>
    <div class="container">
        <div class="name-section" style="text-align: center">
            <h3>Добавить книгу</h3>
        </div>
        <form enctype="multipart/form-data" action="../php/uploadBook.php" method="post">
            <div class="form-group ">
                <input class="form-control form-control-lg mb-2" type="text" name="name" placeholder="Название книги">
                <input class="form-control form-control-lg mb-2" type="text"name="author" placeholder="Ф.И.О. автора">
            </div>
            <div class="form-group">
                <select class="form-control form-control-lg" name="category">
                    <option value="-1" selected>Выберите категорию</option>
                    <?php
                    require_once "../classes/LibraryManager.php";
                    $manager = new LibraryManager();
                    $categories = $manager->getCategories();
                    foreach ($categories as $value){
                        echo '<option value='."'".$value['id']."'".">";
                        echo $value['name'];
                        echo '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Описание книги</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Фотография обложки</label>
                <input class="form-control form-control-lg" id="formImageFile" type="file" name="fileImage"/>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Исходный текст книги</label>
                <input class="form-control form-control-lg" id="formTextFile" type="file" name="fileText"/>
            </div>
            <button type="submit" name="submit" class="btn btn-success mt-3" style="width:200px; height: 45px">Добавить книгу</button>
        </form>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

<?php endif ?>
</html>