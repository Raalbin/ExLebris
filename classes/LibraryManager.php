<?php

require_once "../php/db.php";
require_once "../php/functions.php";

class LibraryManager
{
    //получение всех категорий
    function getCategories()
    {
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `category` ORDER BY `Name_Category`ASC");
        while ($row = $sql->fetch_assoc()) {
            $allRows[] = $row;
        }
        dbclose($mysql);
        return $allRows;
    }
    //получение ID всех избранных книг пользователя. На вход подается $_SESSION['user'].
    function getAllFavoriteID($user)
    {
        $userInfo = getUser($user);
        $userID = $userInfo['Id_Client'];
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `category` WHERE `userID`='$userID'");
        while ($row = $sql->fetch_assoc()) {
            $allRows[] = $row;
        }
        dbclose($mysql);
        if(isset($allRows)){
            return $allRows;
        }else{
            return null;
        }
    }
    //проверяет, добавлена ли книга в список избранных пользователя.
    //на вход подается $_SESSION['user'] и ID книги.
    function checkFavorite($user, $bookID)
    {
        $userInfo = getUser($user);
        $userID = $userInfo['Id_Client'];
        //echo'<br>'.$userID;
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `category` WHERE `userID`='$userID'");
        while ($row = $sql->fetch_assoc()) {
            $allRows[] = $row;
        }
        if (isset($allRows)) {
            foreach ($allRows as $value) {
                if ($bookID == $value['Id_Book']) {
                    return true;
                }
            }
        }
        return false;
    }
    //получить категорию по ее ID;
    function getCategoryByID($catID)
    {
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `category` WHERE `Id_Book_Category` = '$catID'");
        $row = $sql->fetch_assoc();
        dbclose($mysql);
        return $row;
    }

    //получить автора по его ID;
    function getAuthorByID($catID)
    {
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `author` WHERE `Id_Author` = '$catID'");
        $row = $sql->fetch_assoc();
        dbclose($mysql);
        return $row;
    }

    //получить книгу по ее ID;
    function getBookByID($bookID)
    {
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `book` WHERE `Id_Book` = '$bookID'");
        $row = $sql->fetch_assoc();
        dbclose($mysql);
        return $row;
    }

    //найти книгу в базе данных. На вход подается данные с формы поиска
    function findBook($searchField)
    {
        $mysql = dbConnect();

        $likeName = "%{$searchField}%";
        
        $stm = $mysql->prepare("SELECT * FROM book WHERE Name LIKE ? OR Description LIKE ?");
        $stm->bind_param("ss", $likeName, $likeName);
        $stm->execute();

        $res = $stm->get_result();
        $row = $res->fetch_assoc();

        $stm->close();
        dbclose($mysql);

        return $row;
    }
    //получить избранные книги, по полученное строке
    //входная строка приходит в формате "12,16,17", где цифры - id книг.
    function getFavoriteBooksByID($idString){
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `book` WHERE `Id_Book` IN ($idString) ORDER BY `Id_Book` ASC");
        while ($row = $sql->fetch_assoc()) {
            $allRows[] = $row;
        }
        dbClose($mysql);
        return $allRows;
    }
    //получить списка всех книг в бд
    function getBooks()
    {
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `book` ORDER BY `Id_Book` DESC");
        while ($row = $sql->fetch_assoc()) {
            $allRows[] = $row;
        }
        dbclose($mysql);
        return $allRows;
    }
    //получение книг по их категориям. На вход подается ID категории.
    function getBooksByCat($categoryID)
    {
        $mysql = dbConnect();
        $sql = $mysql->query("SELECT * FROM `book` WHERE Id_Category='$categoryID' ORDER BY `Id_Category` DESC");
        while ($row = $sql->fetch_assoc()) {
            $allRows[] = $row;
        }
        dbclose($mysql);
        return $allRows;
    }
    //удаляет книгу. На вход получает ID книги.
    function deleteBook($bookID){
        $mysql = dbConnect();
        $sqlBook = "DELETE FROM `book` WHERE `Id_Book`='$bookID'";
        $mysql->query($sqlBook);
        dbclose($mysql);
    }
}