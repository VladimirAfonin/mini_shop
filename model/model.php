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