<?php
include "dbinit.php";
error_reporting(0);

if ($_POST['oper'] == "alldel") {
    // если пользователь не авторизован
    if ($_POST['id_user'] == 'new_user') {
        mysqli_query($link, $query-> dellAll (NEW_USER));
        echo json_encode(['res' => 'alldel']);
    } else {
        mysqli_query($link, $query->delete_rows_field(CART, 'id_user', $_POST['id_user']));
        echo json_encode(['res' => 'alldel']);
    }
} else
    // если пришел id продукта
    if (isset($_POST['id_product'])) {
        // если пользователь не авторизован
        if ($_POST['id_user'] == 'new_user') {

            $id_product = (int) $_POST['id_product'];

            // если таблица для не авторизованного пользователя существет
            if (mysqli_query($link, $query->selectAll(NEW_USER))) {

                //ище id  продукта в таблице
                $result = find_el_table($link, NEW_USER, 'id_product', $id_product);

                // если id  есть в таблице
                if ($result['flag']) {
                    $id_in_new_user = $result['id'];
                    // если пришел запрос на добавление товара
                    if ($_POST['oper'] == "add") {
                        $res = mysqli_query($link, $query->incPole($id_in_new_user, NEW_USER, 'quant_product'));

                        $all = all_sum_new_user( $query);
                        //  echo $query->incPole($id_in_new_user, NEW_USER, 'quant_product');

                        echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
                    }
                    // если пришел запррос на удаление товара
                    else {
                        // смотрим количество данного товара в корзине
                        $quant = mysqli_fetch_assoc(mysqli_query($link, $query->select_id($id_in_new_user, NEW_USER, 'quant_product')));

                        // если количество данного товара = 1, удалеям его из таблици 
                        if ($quant['quant_product'] == 1) {
                            mysqli_query($link, $query->delete_row_id($id_in_new_user, NEW_USER));
                            echo json_encode(['res' => 'rel']);
                        }
                        // если количество данного товара > 1, уменьшаем его количество на 1
                        else {
                            mysqli_query($link, $query->decPole($id_in_new_user, NEW_USER, 'quant_product'));
                            $all = all_sum_new_user( $query);
                            echo json_encode(['res' => '-', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
                        }
                    }
                    // если продукта нет в таблице добавлеям его
                } else {
                    mysqli_query($link, $query->addOneRow_3(NEW_USER, null, $id_product, 1));
                    $all = all_sum_new_user( $query);
                    echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
                }
                // если нет таблици для не авторизированого пользователя, создаем ее, и добавляем в нее выбранный товар.
            } else {
                mysqli_query($link, $query->creat_Table_NewUser());
                mysqli_query($link, $query->addOneRow_3(NEW_USER, null, $id_product, 1));
                $all = all_sum_new_user( $query);
                echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
            }
            //  если пользователь авторизован, то ... / алгоритм точно такойже что и выше
        } else {

            $id_product = (int) $_POST['id_product'];
            $id_user = (int) $_POST['id_user'];
            $arr = getArrPole($link, CART, 'id_user');

            if ($arrIndex = array_keys($arr, $id_user)) {

                foreach ($arrIndex as $key => $val) {
                    if ($id_product == getArrPole($link, CART, 'id_product')["$val"]) {
                        $index_i = getArrPole($link, CART, 'id')["$val"];
                        $flag = true;
                    }
                }

                if ($flag) {
                    if ($_POST['oper'] == "add") {
                        mysqli_query($link, $query->incPole($index_i, CART, 'quantity'));
                        $all =  all_sum_cart($link, $query, $_POST['id_user']);
                        echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
                    } else {
                        $quant = mysqli_fetch_assoc(mysqli_query($link, $query->select_id($index_i, CART, 'quantity')));
                        if ($quant['quantity'] == 1) {
                            mysqli_query($link, $query->delete_row_id($index_i, CART));
                            echo json_encode(['res' => 'rel']);
                        } else {
                            mysqli_query($link, $query->decPole($index_i, CART, 'quantity'));
                            $all =  all_sum_cart($link, $query, $_POST['id_user']);
                            echo json_encode(['res' => '-', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
                        }
                    }
                } else {
                    $res = mysqli_query($link, $query->addOneRow_4(CART, null, $id_user, $id_product, '1'));
                    $all =  all_sum_cart($link, $query, $_POST['id_user']);
                    echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
                }
            } else {
                $res = mysqli_query($link, $query->addOneRow_4(CART, null, $id_user, $id_product, '1'));
                $all =  all_sum_cart($link, $query, $_POST['id_user']);
                echo json_encode(['res' => 'add', 'allSum' => $all['sum'], 'allQuant' => $all['quant']]);
            }
        }
    }
