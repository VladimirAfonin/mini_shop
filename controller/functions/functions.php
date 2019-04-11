<?php

defined('ISHOP') or die('Access denied');

/* ===Распечатка массива=== */
function print_arr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

/* ===добавление в корзину=== */
function addtocart($goods_id, $qty = 1){
    if(isset($_SESSION['cart'][$goods_id])) {
        $_SESSION['cart'][$goods_id]['qty'] += $qty;
        return $_SESSION['cart'];
    } else {
        $_SESSION['cart'][$goods_id]['qty'] = $qty;
        return $_SESSION['cart'];
    }
}

/* === redirect === */
function redirect(){
    $redirect = ($_SERVER['HTTP_REFERER']) ?: PATH;
    header("Location: " . $redirect);
    exit();
}

/* === redirect === */
function total_quantity() {
    $_SESSION['total_qty'] = 0;
    foreach($_SESSION['cart'] as $key => $value) {
        if(isset($value['price'])) {
            $_SESSION['total_qty'] += $value['qty'];
        } else {
            unset($_SESSION['cart'][$key]);
        }
    }
}