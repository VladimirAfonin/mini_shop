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
        total_quantity();
        redirect();
        break;

    case('cart'):
        // корзина
        // - пересчет кол-ва
        if(isset($_GET['gid'], $_GET['qty'])) {
            $goods_id = (int)$_GET['gid'];
            $qty = (int)$_GET['qty'];

            $qty = $qty - $_SESSION['cart'][$goods_id]['qty'];
            addtocart($goods_id, $qty);
            total_quantity();
            $_SESSION['total_sum'] = total_sum($_SESSION['cart'], $connect);
            redirect();
        }
        if(isset($_GET['delete'])) {
            $goods_id = (int)$_GET['delete'];
            if($goods_id) {
                delete_from_cart($goods_id);
            }
            redirect();
        }

        break;

}

// подключени вида
require_once TEMPLATE.'index.php';