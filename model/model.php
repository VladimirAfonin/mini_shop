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

    $str_goods = implode(',', array_keys($session));

    $query = "SELECT goods_id, name, price, img FROM goods  
                 WHERE goods_id IN ($str_goods)";
    
    $res = mysqli_query($connect, $query) or die(mysqli_error($connect));

    while($row = mysqli_fetch_assoc($res)) {
        $_SESSION['cart'][$row['goods_id']]['name'] = $row['name'];
        $_SESSION['cart'][$row['goods_id']]['price'] = $row['price'];
        $_SESSION['cart'][$row['goods_id']]['img'] = $row['img'];
        $total_sum += $_SESSION['cart'][$row['goods_id']]['qty'] * $row['price'];
    }

    return $total_sum;
}

/* ===удаление из корзины === */
function delete_from_cart($goods_id){
    if($_SESSION['cart']) {
        if(array_key_exists($goods_id, $_SESSION['cart'])) {
            $_SESSION['total_qty'] -= $_SESSION['cart'][$goods_id]['qty'];
            $_SESSION['total_sum'] -= $_SESSION['cart'][$goods_id]['price'];
            unset($_SESSION['cart'][$goods_id]);
        }
    }
}

/* ===оформление заказа === */
function save_order($connect, $status = true){
    // сохраняем 'orders'
    $query = "INSERT INTO orders (`customer_id`, `date`, `dostavka_id`, `prim`) 
                VALUES (1, NOW(), 1, 'some text here...')";

   $res = mysqli_query($connect, $query) or die(mysqli_error($connect));
   if(mysqli_affected_rows($connect) == -1) {
       return false;
   }

    // сохраняем 'zakaz_order'
   $order_id = mysqli_insert_id($connect);
   $val = '';
   foreach($_SESSION['cart'] as $goods_id => $value) {
       $val .= "($order_id, $goods_id, {$value['qty']}),";
   }
    $val = substr($val, 0, -1); // убираем последнюю запятую


   $q = "INSERT INTO zakaz_tovar (`orders_id`, `goods_id`, `quantity`)
          VALUES $val";

    $res = mysqli_query($connect, $q) or die(mysqli_error($connect));
    if(mysqli_affected_rows($connect) == -1) {
        mysqli_query($connect, "DELETE FROM orders WHERE order_id = $order_id");
        return false;
    }

    return $status;
}