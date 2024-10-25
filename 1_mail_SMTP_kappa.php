<?php

/***************************************** (1) Подключение к серверу *****************************************/

$smtp_connection = fsockopen("mail.cs.karelia.ru", 25, $errno, $errstr, 10); // устанавливаем соединение с почтовым сервером
if (!$smtp_connection) {
    echo "Connection Error: $errstr ($errno)\n"; // выводим ошибку подключения
    exit();
}

/***************************************** (2) Проверка подлинности и приветствие *****************************************/

echo nl2br(fgets($smtp_connection)); // получаем приветствие от сервера 

fputs($smtp_connection, "HELO gordeev@kappa.cs.petrsu.ru\r\n"); // запись данных в открытое SMTP-соединение между сервером и клиентской программой
echo nl2br("HELO gordeev@kappa.cs.petrsu.ru\r\n");
echo nl2br(fgets($smtp_connection)); // получаем ответ от сервера

/***************************************** (3) Установление отправителя *****************************************/

fputs($smtp_connection, "MAIL FROM:<gordeev@cs.petrsu.ru>\r\n"); // отправляем MAIL FROM
echo nl2br("MAIL FROM:<gordeev@cs.petrsu.ru>\r\n");
echo nl2br(fgets($smtp_connection));

/***************************************** (4) Установление получателей *****************************************/

fputs($smtp_connection, "RCPT TO:<gordeev@cs.petrsu.ru>\r\n"); // отправляем RCPT TO
echo nl2br("RCPT TO:<gordeev@cs.petrsu.ru>\r\n");
echo nl2br(fgets($smtp_connection));

/***************************************** (5) Отправка письма *****************************************/

fputs($smtp_connection, "DATA\r\n"); // отправляем DATA
echo nl2br("DATA\r\n");
echo nl2br(fgets($smtp_connection));

// отправляем сообщение
fputs($smtp_connection, "From: Отправитель Никита Гордеев <gordeev@cs.petrsu.ru>\r\n");
fputs($smtp_connection, "To: Получатель Никита Гордеев <gordeev@cs.petrsu.ru>\r\n");
fputs($smtp_connection, "Subject: Web-технологии, лабораторая 3, часть 1 новая\r\n");
fputs($smtp_connection, "Content-type: text/plain; charset=utf-8\r\n");
fputs($smtp_connection, "\r\n");
fputs($smtp_connection, "Сообщение на собственный ящик.\r\n");
fputs($smtp_connection, ".\r\n"); // символ окончания сообщения
echo nl2br(fgets($smtp_connection));

/***************************************** (6) Закрытие соединения *****************************************/

fputs($smtp_connection, "QUIT\r\n"); // отправляем QUIT
echo nl2br("QUIT\r\n");
echo nl2br(fgets($smtp_connection));

fclose($smtp_connection); // закрываем соединение
?>