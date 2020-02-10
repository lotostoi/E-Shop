<?php
include "./../models/dbinit.php";
include "./../models/mod_makeOder.php";

$cart_user = getArrRows($link, CART, 'id_user', $_POST['id_user'])[0]; 
$user = getArrRows($link, USERS, 'id', $_POST['id_user'])[0];

$name_order = $_POST['name_order'];
$phone_order = $_POST['phone_order'];
$email_order = $_POST['email_order'];
$text_order = $_POST['text_order'];
$inform_order = json_encode($cart_user);
$date_order = $dateUser = date('Y-m-d h:i:s');
$allSum_order = all_sum_new_user($query)['sum'];
$allQuant_order = all_sum_new_user($query)['quant'];
if (isset($_POST['makeOrder']) && count($cart_user)>0) {
    if ($name_order != '' && $phone_order != '' && $email_order != '' && $text_order != '') {
        $add = mysqli_query($link, $query->addOneRow_10(ORDERS, null, $name_order, $date_order, $email_order, $phone_order, $allSum_order, $allQuant_order, $inform_order, $text_order, null));
        // очищаем временного юзера
        mysqli_query($link, $query->delete_rows_field(CART, 'id_user', $_POST['id_user']));
        if ($add) {
            header("Location:./../E-Shop.php?page=orderSend");
        }
    } else {
        header("Location:./../E-Shop.php?page=cart&status_order=fields");
    }
}else {
    header("Location:./../E-Shop.php?page=cart");
}
