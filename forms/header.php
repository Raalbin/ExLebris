<nav class="navbar navbar-inverse  navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">
            <a class="menu" style="text-decoration: none; color: rgba(255,255,255,.55);" href="main-page.php">
            <img src="../icons/miniLogo.png" alt="" width="35" height="33" class="d-inline-block align-top">
            ExLibris</span>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse container-fluid " id="navbarSupportedContent">
            <div class="menu" style="display: inline-block">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="review" href="../forms/main-page.php">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="review" href="../forms/favorites.php">Корзина</a>
                    </li>

                    <?php
                    require_once "../php/functions.php";
                    if (isAdmin($_SESSION['user'])) {
                        echo '<li class="nav-item">
                    <a class="nav-link" aria-current="review" href="../admin/admin-panel.php">Админ панель</a>
                </li>';
                    } else if (isModerator($_SESSION['user'])) {
                        echo '<li class="nav-item">
                        <a class="nav-link" aria-current="about" href="upload-book.php">Добавить книгу</a>
                    </li>';
                    }
                    ?>
                </ul>

            </div>

            <form class="input-group" action="../php/searchBook.php" style=" margin-right: 25px;" method="get">
                <input type="search" name="searchingField" class="form-control" placeholder="Поиск книги"/>
                <button type="submit" class="btn btn-outline-light">Найти</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="../php/exit.php">Выйти</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
