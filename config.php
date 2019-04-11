<?php

defined('ISHOP') or die('Access denied');

// домен
define('PATH', 'http://minishop.loc/');

// модель
define('MODEL', 'model/model.php');

// контроллер
define('CONTROLLER', 'controller/controller.php');

// вид
define('VIEW', 'views/');

// активный шаблон
define('TEMPLATE', 'ishop/');

// сервер БД
define('HOST', 'localhost');

// пользователь
define('USER', 'root');

// пароль
define('PASS', '12345');

// БД
define('DB', 'test');

// название магазина - title
define('TITLE', 'Интернет магазин телефонов');

$connect = mysqli_connect(HOST, USER, PASS) or die('No connect to Server');
mysqli_select_db($connect, DB) or die('No connect to DB');
//mysqli_query("SET NAMES 'UTF8'") or die('Cant set charset');