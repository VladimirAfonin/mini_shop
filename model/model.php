<?php

defined('ISHOP') or die('Access denied');


/* ====Каталог - получение массива=== */
function catalog($connect){
    $query = "SELECT * FROM brands ORDER BY parent_id, brand_name";
    $res = mysqli_query($connect, $query) or die(mysqli_query($connect));

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