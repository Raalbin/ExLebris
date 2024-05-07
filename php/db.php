<?php
//возращает соединение с базой данных.
function dbConnect(){
        $mysql = new mysqli("localhost", "puankare_vit", "gJire)398wkMs", "puankare_vit");
        //$mysql->set_charset('utf8');
        $mysql->query("SET NAMES utf8 COLLATE utf8_general_ci");
        return $mysql;
}
//закрывает соединение с базой данных.
function dbClose($mysqli){
    $mysqli->close();
}

