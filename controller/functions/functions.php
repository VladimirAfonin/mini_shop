<?php

defined('ISHOP') or die('Access denied');

/* ===Распечатка массива=== */
function print_arr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

/* ===добавление в корзину=== */
function addtocart($goods_id){
    if(isset($_SESSION['cart'][$goods_id])) {
        $_SESSION['cart'][$goods_id]['qty'] += 1;
        return $_SESSION['cart'];
    } else {
        $_SESSION['cart'][$goods_id]['qty'] = 1;
        return $_SESSION['cart'];
    }
}

/* === redirect === */
function redirect(){
    $redirect = ($_SERVER['HTTP_REFERER']) ?: PATH;
    header("Location: " . $redirect);
    exit();
}