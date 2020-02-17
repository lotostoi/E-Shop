<?php
include "./../models/dbinit.php";
error_reporting(0);

if ($_POST['oper'] == "alldel") {
    mysqli_query($link, $query->delete_rows_field(CART, 'id_user', $_POST['id_user']));
    echo json_encode(['res' => 'alldel']);
}
// если пришел id продукта
if (isset($_POST['id_product'])) {

    $id_product = (int) $_POST['id_product'];
    $id_user = (int) $_POST['id_user'];
    $arr = getArrPole($link, CART, 'id_user');
   // print_r($arr);

    if ($arrIndex = array_keys($arr, $id_user)) {

        foreach ($arrIndex as $key => $val) {
            if ($id_product == getArrPole($link, CART, 'id_product')["$val"]) {
                $index_i = getArrPole($link, CART, 'id')["$val"];
                $flag = true;
            }
        }

        // если id  есть в таблице
        if ($flag) {
            // если пришел запрос на добавление товара
            if ($_POST['oper'] == "add") {
                mysqli_query($link, $query->incPole($index_i, CART, 'quantity'));
                $all =  all_sum_cart($link, $query, $_POST['id_user']);
                echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
                // если пришел запррос на удаление товара
            } else {
                // смотрим количество данного товара в корзине
                $quant = mysqli_fetch_assoc(mysqli_query($link, $query->select_id($index_i, CART, 'quantity')));

                // если количество данного товара = 1, удалеям его из таблици 
                if ($quant['quantity'] == 1) {
                    mysqli_query($link, $query->delete_row_id($index_i, CART));
                    echo json_encode(['res' => 'rel']);
                    // если количество данного товара > 1, уменьшаем его количество на 1    
                } else {
                    mysqli_query($link, $query->decPole($index_i, CART, 'quantity'));
                    $all =  all_sum_cart($link, $query, $_POST['id_user']);
                    echo json_encode(['res' => '-', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
                }
            }
            // если продукта нет в таблице добавлеям его
        } else {
            $res = mysqli_query($link, $query->addOneRow_4(CART, null, $id_user, $id_product, '1'));
            $all =  all_sum_cart($link, $query, $_POST['id_user']);
            echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
        }
        // если id юзера нет в таблице добавлеям его и товр  в таблицу
    } else {
        $res = mysqli_query($link, $query->addOneRow_4(CART, null, $id_user, $id_product, '1'));
        $all =  all_sum_cart($link, $query, $_POST['id_user']);
        echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
    }
}
