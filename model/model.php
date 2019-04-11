<?php

defined('ISHOP') or die('Access denied');


/* ====Каталог - получение массива=== */
function catalog($connect){
    $query = "SELECT * FROM brands ORDER BY parent_id, brand_name";
    $res = mysqli_query($connect, $query) or die(mysqli_error($connect));

    //массив категорий
    $cat = [];
    while($row = mysqli_fetch_assoc($res)){
        if(!$row['parent_id']){
            $cat[$row['brand_id']][] = $row['brand_name'];
        }else{
            $cat[$row['parent_id']]['sub'][$row['brand_id']] = $row['brand_name'];
        }
    }
    return $cat;
}
/* ====Каталог - получение массива=== */

/* ===Получение массива товаров по категории=== */
function products($category, $connect){
    $query = "(SELECT goods_id, name, img, anons, price, hits, new, sale
                 FROM goods
                     WHERE goods_brandid = $category AND visible='1')
               UNION      
               (SELECT goods_id, name, img, anons, price, hits, new, sale
                 FROM goods 
                     WHERE goods_brandid IN 
                (
                    SELECT brand_id FROM brands WHERE parent_id = $category
                ) AND visible='1')";
    $res = mysqli_query($connect, $query) or die(mysqli_error($connect));

    $products = array();
    while($row = mysqli_fetch_assoc($res)){
        $products[] = $row;
    }

    return $products;
}
/* ===общая сумма в корзине=== */
function total_sum($session, $connect) {
    $total_sum = 0;

    $str_goods = implode(',',array_keys($session));

    $query = "SELECT goods_id, name, price FROM goods  
                 WHERE goods_id IN ($str_goods)";
    
    $res = mysqli_query($connect, $query) or die(mysqli_error($connect));

    while($row = mysqli_fetch_assoc($res)) {
        $_SESSION['cart'][$row['goods_id']]['name'] = $row['name'];
        $_SESSION['cart'][$row['goods_id']]['price'] = $row['price'];
        $total_sum += $_SESSION['cart'][$row['goods_id']]['qty'] * $row['price'];
    }

    return $total_sum;
}