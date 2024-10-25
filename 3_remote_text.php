<style>
    span {
        font-size: 20px;
    }
    .button-container{
        margin-top: 20px;
    }
</style>

<?php
session_start(); // запуск сессии

if (empty($_SESSION["check"])) { // пользователь не авторизован
    echo 'У вас нет доступа к файлу.', '<br>', 'Вы будете перенаправлены на страницу авторизации.';
    echo '<meta http-equiv="refresh" content="2; url=http://kappa.cs.petrsu.ru/~gordeev/php/lab_3/3_login.php">'; // перенаправляем
} 

else {    
    if (isset($_POST['exit'])) { 
        $_SESSION = array(); // уничтожение данных в сессии
        header('Location: http://kappa.cs.petrsu.ru/~gordeev/php/lab_3/3_login.php');
    } 

    $fortune = file_get_contents("http://kappa.cs.petrsu.ru/~kulakov/courses/php/fortune.php"); // слуайная фраза
    $fortune = strip_tags($fortune); // удаляем HTML, PHP, XML теги 
    $fortune = str_replace('Fortune', '', $fortune); // удаляем слово Fortune
    $fortune = trim($fortune); // убираем лишние пробелы в начале или конце строки    
    echo '<span>' . nl2br($fortune) . '</span>';
    
    echo '<div class="button-container">
        <form method="post">
            <input type="submit" class="button" name="exit" value="Выйти из учетной записи" />
        </form>
    </div>'; // кнопка выхода
}

?>
