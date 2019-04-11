<?php

defined('ISHOP') or die('Access denied');

session_start();

// подключение модели
require_once MODEL;

// подключение библиотеки функций
require_once 'functions/functions.php';

// получение массива каталога
$cat = catalog($connect);

// получение динамичной части шаблона #content
$view = empty($_GET['view']) ? 'hits' : $_GET['view'];

switch($view){
    case('cat'):
        // товары категории
        $category = abs((int)$_GET['category']);
        $products = products($category, $connect); // получаем массив из модели
        break;


}

// подключени вида
require_once TEMPLATE.'index.php';