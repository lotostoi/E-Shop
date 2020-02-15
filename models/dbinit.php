<?php

const SERVNAME = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DBNAME = 'shop_e';
const CART = 'cart';
const SHOPE = 'shope';
const USERS = 'users';
const COTALOG = 'cotalog';
const NEW_USER = 'new_user';
const ORDERS = 'orders';


$link = mysqli_connect(SERVNAME, USERNAME, PASSWORD, DBNAME) or die("Error - 404");





// класс генерирующий запросы к базе данных

class QueryToMysqli
{
    function incPole($id, $db, $pole)
    {
        return  "UPDATE $db SET $pole = $pole + 1 WHERE id ='$id'";
    }
    function decPole($id, $db, $pole)
    {
        return  "UPDATE $db SET $pole = $pole - 1 WHERE id ='$id'";
    }
    function inc_pole_pole($pole_key, $valPole, $db, $pole)
    {
        return  "UPDATE $db SET $pole = $pole + 1 WHERE $pole_key ='$valPole'";
    }
    function dellAll($tab)
    {
        return  "DELETE FROM $tab";
    }
    function dellOneRow($id, $db)
    {
        return  "DELETE FROM $db WHERE id = $id ";
    }
    // изменить строку
    function updateRow_5($db, $id, $field1, $arg1, $field2, $arg2, $field3, $arg3, $field4, $arg4, $field5, $arg5)
    {
        return  "UPDATE $db SET $field1 =$arg1, $field2=$arg2, $field3=$arg3 , $field4=$arg4, $field5=$arg5 WHERE id= $id";
    }
    function updateRow_4($db, $id, $field1, $arg1, $field2, $arg2, $field3, $arg3, $field4, $arg4)
    {
        return  "UPDATE $db SET $field1 =$arg1, $field2=$arg2, $field3=$arg3 , $field4=$arg4 WHERE id= $id";
    }
    // добоавить строку
    function addOneRow_3($db, $arg1, $arg2, $arg3)
    {
        return  "INSERT INTO $db VALUES ('$arg1', '$arg2','$arg3')";
    }
    function addOneRow_4($db, $arg1, $arg2, $arg3, $arg4)
    {
        return  "INSERT INTO $db VALUES ('$arg1', '$arg2','$arg3' , '$arg4')";
    }
    function addOneRow_5($db, $arg1, $arg2, $arg3, $arg4, $arg5)
    {
        return  "INSERT INTO $db VALUES ('$arg1', '$arg2', '$arg3', '$arg4', '$arg5')";
    }
    function addOneRow_6($db, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6)
    {
        return  "INSERT INTO $db VALUES ('$arg1', '$arg2','$arg3' , '$arg4', '$arg5', '$arg6' )";
    }
    function addOneRow_7($db, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7)
    {
        return  "INSERT INTO $db VALUES ('$arg1', '$arg2','$arg3' , '$arg4', '$arg5', '$arg6', '$arg7' )";
    }
    function addOneRow_10($db, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10)
    {
        return  "INSERT INTO $db VALUES ('$arg1', '$arg2','$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10' )";
    }

    function select($pole, $db)
    {
        return  "SELECT $pole FROM $db";
    }
    function select_id($id, $db, $pole)
    {
        return  "SELECT $pole FROM $db WHERE id = $id";
    }
    function select_row_id($id, $db)
    {
        return  "SELECT * FROM $db WHERE id = $id";
    }
    function delete_row_id($id, $db)
    {
        return  "DELETE FROM $db WHERE id = $id";
    }
    function select_rows_field($db, $pole, $val_pole)
    {
        return  "SELECT * FROM $db WHERE $pole = $val_pole";
    }
    function delete_rows_field($db, $pole, $val_pole)
    {
        return  "DELETE FROM $db WHERE $pole = $val_pole";
    }
    function sort_max_min($db, $pole)
    {
        return  "SELECT * FROM $db ORDER BY $pole DESC";
    }
    function selectAll($db)
    {
        return  "SELECT * FROM $db ";
    }
    function createDB($db)
    {
        return  "CREATE DATABASE $db";
    }
    function deleteDB($db)
    {
        return  "DROP DATABASE $db";
    }
    function deleteTable($db)
    {
        return  "DROP TABLE $db";
    }
    function creat_Table_NewUser()
    {
        return  "CREATE Table new_user
        (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            id_product INT NOT NULL,
            quant_product INT NOT NULL
        )";
    }
}

$query = new QueryToMysqli;


function getArr($link, $db)
{
    $res = mysqli_query($link, $GLOBALS['query']->selectAll($db));
    if (!$res) {
        return;
    };
    $i = 0;
    while ($content = mysqli_fetch_assoc($res)) {
        $arr[$i++] = $content;
    }
    return $arr;
}
function getArrPole($link, $db, $pole)
{
    $res = mysqli_query($link, $GLOBALS['query']->selectAll($db));
    if (!$res) die("Error - ." . mysqli_error($link));
    $i = 0;
    while ($content = mysqli_fetch_assoc($res)) {
        $arr[$i++] = $content["$pole"];
    }
    return $arr;
}
// ищет $currentVal в поле $field таблици $table и возвращет массив 
//с флагом (true/false) и индексом по которому произолшло совпадение.
function find_el_table($link, $table, $field, $currentVal)
{
    //$arr = getArrPole($link, $table, $field);
    $arr =  getArr($link, $table);

    foreach ($arr as $key => $val) {
        if ($val["$field"] == $currentVal) {
            $flag = true;
            $index = $key;
            $id_el = $val['id'];
        }
    };
    return ['flag' => $flag, 'index' => $index, "id" => $id_el];
}
// ищет $currentVal в поле $field таблици $table и возвращет массив 
// массив id удовлетворяющих условию поиска
function getArrfields($link, $table, $field, $currentVal)
{
    $arr = getArr($link, $table);
    $i = 0;
    foreach ($arr as $key => $val) {
        if ($val["$field"] == $currentVal) {
            $newArr[$i++] = $arr["$key"]["id"];
        }
    }
    return $newArr;
}
// ищет $currentVal в поле $field таблици $table и возвращет массив 
// массив строк удовлетворяющих условию поиска
function getArrRows($link, $table, $field, $currentVal)
{
    $arr = getArr($link, $table);
    $i = 0;
    foreach ($arr as $key => $val) {
        if ($val["$field"] == $currentVal) {
            $newArr[$i++] = $arr["$key"];
        }
    }
    return $newArr;
}
// вычисляет общую сумму корзины и количество товаров
function all_sum_cart($link, $query, $id_user)
{
    $newArr =  getArrfields($link, CART, 'id_user', $id_user);
    foreach ($newArr as $key => $val) {
        $res = mysqli_query($link, $query->select_row_id($val, CART));
        $str = mysqli_fetch_assoc($res);
        $quant = $str['quantity'];
        $id = $str['id_product'];
        $res_pr = mysqli_fetch_assoc(mysqli_query($link, $query->select_row_id($id, COTALOG)));
        $price_cart = $res_pr['price'];
        $allQuant += $quant;
        $allSum += $quant * $price_cart;
    }
    return ['sum' =>  $allSum, "quant" =>  $allQuant];
}

