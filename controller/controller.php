<?php

defined('ISHOP') or die('Access denied');

session_start();

// подключение модели
require_once MODEL;

// подключение библиотеки функций
require_once 'functions/functions.php';

// получение массива каталога
$cat = catalog($connect);

// оформление заказа
if($_POST['order']){
    $res = save_order($connect);
    if($res){
        // если заказ сохранен
        unset($_SESSION['cart'], $_SESSION['total_sum'], $_SESSION['total_qty']);
        echo $_SESSION['order']['res'] = "<div class='success'>Заказ оформлен успешно и сохранен в БД!</div>";
        mail_order($res);
        exit;
    }else{
        // если заказ не сохранен
        echo $_SESSION['order']['res'] = "<div class='error'>Ошибка при оформлении заказа!</div>";
        exit;
    }
}

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
        if(isset($_GET['delete_all'])) {
            unset($_SESSION['cart'], $_SESSION['total_sum'], $_SESSION['total_qty']);
            redirect();
        }
        break;

}

// подключени вида
require_once TEMPLATE.'index.php';