<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>
    .alert {
        width: 220px;
        margin: 0 auto;
        text-align: center;
        display: flex;
        justify-content: center;
    }
</style>

<?php
require_once "../php/db.php";

$mysql = dbConnect();
if ($mysql && $_SESSION['count'] == 0):
    $_SESSION['count'] = 1;
    ?>
 

<?php elseif (!$mysql): ?>
    
<?php
elseif ($_SESSION['flag'] == 1):
    $_SESSION['flag'] = 0
    ?>
    <div class="alert alert-warning" role="alert">
        Теперь вы можете войти под созданным аккаунтом!
    </div>

<?php
elseif ($_SESSION['flag'] == -1):
    $_SESSION['flag'] = 0
    ?>
    <div class="alert alert-danger" role="alert">
        Пароли не совпадают! Повторите попытку.
    </div>

<?php
elseif ($_SESSION['flag'] == -2):
    $_SESSION['flag'] = 0
    ?>
    <div class="alert alert-danger" role="alert">
        Неверный логин или пароль!
    </div>

<?php
elseif ($_SESSION['flag'] == -3):
    $_SESSION['flag'] = 0
    ?>
    <div class="alert alert-danger" role="alert">
        Такой пользователь уже существует!
    </div>
<?php
elseif ($_SESSION['flag'] == 4):
    $_SESSION['flag'] = 0
    ?>
    <div class="alert alert-danger" role="alert">
        Операция успешно выполнена!
    </div>
<?php
elseif ($_SESSION['flag'] == -4):
    $_SESSION['flag'] = 0
    ?>
    <div class="alert alert-danger" role="alert">
        Во время выполнения операции произошла ошибка!
    </div>
<?php
elseif ($_SESSION['flag'] == -5):
    $_SESSION['flag'] = 0
    ?>
    <div class="alert alert-danger" role="alert">
        Неправильный email. Введите данные еще раз.
    </div>
<?php
elseif ($_SESSION['flag'] == -6):
    $_SESSION['flag'] = 0
    ?>
    <div class="alert alert-danger" role="alert">
        Пароль должен содержать более 7 символов!
    </div>
<?php endif ?>


<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('.alert').fadeOut("slow");
        }, 2000);
    });
</script>

