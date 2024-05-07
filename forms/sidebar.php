<div class="panel-group"style=" text-align: center" ">
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title ">
            <a>Список жанров</a>
        </h5>
    </div>
    <div class="list-group">
        <?php
        include_once "../classes/LibraryManager.php";
        $libraryManager = new LibraryManager();
        $categories = $libraryManager->getCategories();
        foreach($categories as $value){
            echo '<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href =?cat='.$value['Id_Book_Category'].'>';
            echo $value['Name_Category'];
            echo '<span class="badge bg-success rounded-pill">';
            echo $value['book_count'];
            echo'</span>';
            echo '</a>';
        }
        ?>
    </div>
</div>
</div>
