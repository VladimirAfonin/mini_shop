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
        $category = ((int)$_GET['category']);
        $products = products($category, $connect); // получаем массив из модели
        break;

    case('addtocart'):
        // добавление в корзину
        $goods_id = (int)$_GET['goods_id'];
        addtocart($goods_id);

        $_SESSION['total_sum'] = total_sum($_SESSION['cart'], $connect);
        $_SESSION['total_qty'] = 0;
        foreach($_SESSION['cart'] as $key => $value) {
            if(isset($value['price'])) {
                $_SESSION['total_qty'] += $value['qty'];
            } else {
                unset($_SESSION['cart'][$key]);
            }
        }
        redirect();
        break;

    case('cart'):
        // корзина

}

// подключени вида
require_once TEMPLATE.'index.php';