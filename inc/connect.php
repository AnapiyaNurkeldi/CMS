<?php 
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'blog');
    $connect = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // if (!$connect) {
    //     die('Ошибка подключения к базе данных');
    // }else {
    //     echo 'Подключение к базе данных успешно';
    // }
?>