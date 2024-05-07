<?php


class FileManager
{
    //возвращает путь к файлу с обложкой книги. На вход получает ID книги.
    function getImagePath($folderID)
    {
        $dir = "../storage/" . $folderID;
        $files1 = scandir($dir);
        if ($files1 == false) {
            $fp = self::createStorage($folderID);
            $lm = new LibraryManager();
            $book = $lm->getBookByID($folderID);
            file_put_contents($fp . "/image.jpg", $book['Cover_Image']);
            $files1 = scandir($dir);
        }

        foreach($files1 as $value){
            if($value=='image.png'||$value=='image.jpg'){
                return  "../storage/" . $folderID. "/" .$value;
            }
        }
    }

    //возращает путь к файлу fb2. В нем содержится текст книги.
    function getTextPath($folderID)
    {
        $dir = $_SERVER["DOCUMENT_ROOT"] . "/HomeLibrary/storage/" . $folderID;;
        $files1 = scandir($dir);
        foreach($files1 as $value){
            if($value=='text.pdf'||$value=='text.fb2'){
                return $dir."/".$value;
            }
        }
    }

    //создает директорию под объект. В данном случае, объектом является ID книги.
    function createStorage($objectID)
    {
        $filepath = "../storage/" . $objectID;
        if (@mkdir($filepath)) {
            return $filepath;
        } else {
            die('Не удалось создать директорию под книгу');
        }
    }

    //удаляет директорию. На вход получает путь диеректории.
    function deleteDirectory($dirPath){
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath должен быть указан путь к директории");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDirectory($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    //добавляет файл в директорию. На вход подается имя файла, путь и тип.
    //fileType = 1 - png,jpg. = 0 - fb2;
    function addFile($fileName, $path, $type)
    {
        if ($type == 0) {
            $name = 'text';
            $allowedfileExtensions = array('fb2', 'pdf');
        } else if ($type == 1) {
            $name = 'image';
            $allowedfileExtensions = array('png', 'jpg');
        }
        if (isset($_FILES[$fileName]) && $_FILES[$fileName]['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fileName]['tmp_name'];
            $fileName = $_FILES[$fileName]['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = $name . '.' . $fileExtension;
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $uploadFileDir = $path;
                $dest_path = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $_SESSION['flag']=4;
                    return true;
                } else {
                    $_SESSION['flag']=-4;
                    return false;
                }
            }else{
                $_SESSION['flag']=-4;
                return false;
            }
        }else{
            $_SESSION['flag']=-4;
            return false;
        }
    }
    //парсит содержимое fb2 файла. На вход получает путь к папке.
    function simpleFb2ShowParser($filePath)
    {
        //Читаем файл.
        //Создаем XML документ
        $doc = new DOMDocument();
        //Отключаем проверку ошибок
        $doc->strictErrorChecking = false;
        $doc->recover = true;
        //Загружаем содержимое файла и выводим на экран
        $load = $doc->load($filePath, LIBXML_NOERROR);
        $section = $doc->getElementsByTagName('section');
        $section_count = count($section);
        for ($i = 1; $i < $section_count; $i++) {
            $stringXML = $doc->saveXML($section->item($i));
            echo $stringXML;
        }
    }
}