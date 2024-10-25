<?php
    
    $cookie_count = "0"; // имя Cookie 
    $cookie_time = time() + 10; // время жизни 10 секунд

    
    if (!isset($_COOKIE[$cookie_count])) { // если Cookie с нужным именем не установлен 
        echo "Добро пожаловать!"; // выводим сообщение о первом посещении
        setcookie($cookie_count, 1, $cookie_time); // устанавливаем значение Cookie для первого посещения
    } else { // Cookie уже установлен
        $N = $_COOKIE[$cookie_count] + 1; // увеличиваем его значение на 1
        echo "Вы посетили эту страницу $N-й раз"; // выводим сообщение о количестве посещений
        setcookie($cookie_count, $N, $cookie_time); // обновляем значение Cookie
    }
?>
