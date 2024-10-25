<style>
.login-form input[type="submit"] {
    margin-top: 20px;
}
</style>

<?php
session_start(); // запуск сессии (сохранять данные между запросами пользователя к веб-сайту)
$hash_password = password_hash('qwerty', PASSWORD_DEFAULT); // xеш пароля пользователя


if (isset($_SESSION['check']) && $_SESSION['check']) { // авторизован ли пользователь? (существует и true)
    header('Location: http://kappa.cs.petrsu.ru/~gordeev/php/lab_3/3_remote_text.php'); // перенаправляем
    exit;
}

if (isset($_POST['login'], $_POST['password'])) { // eсли пользователь отправил форму с данными
    $login = $_POST['login'];
    $password = $_POST['password'];

    $access_granted = ($login === 'user' && password_verify($password, $hash_password)); // проверка логина и пароля

    $_SESSION["check"] = $access_granted;

    if (!$access_granted) { // доступ не разрешён
        $_SESSION["wrong"] = true; // сохраняем ошибку в сессию
    } else {
        header('Location: http://kappa.cs.petrsu.ru/~gordeev/php/lab_3/3_remote_text.php'); // перенаправляем
        exit;
    }
}

$error_message = (isset($_SESSION['wrong']) && $_SESSION['wrong']) ? 'Ошибка: введены неправильные данные.' : '';

echo '<form method="post" class="login-form"> 
        Логин: <input type="text" name="login"><br>
        Пароль: <input type="password" name="password"><br>
        <input type="submit">
        '. $error_message .'
     </form>'; // выводим форму для входа
?>