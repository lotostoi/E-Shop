<?php
include "./../models/dbinit.php";
include "./../models/mod_makeOder.php";
$name_order = $_POST['name_order'];
$phone_order = $_POST['phone_order'];
$email_order = $_POST['email_order'];
$text_order = $_POST['text_order'];
$inform_order = getJsonTable_newUser($link);
$date_order = $dateUser = date('Y-m-d h:i:s');
$allSum_order = all_sum_new_user($query)['sum'];
$allQuant_order = all_sum_new_user($query)['quant'];
if (isset($_POST['makeOrder'])) {
    if ($name_order!= '' && $phone_order != '' && $email_order != '' && $text_order != '') {
            $add = mysqli_query($link, $query->addOneRow_10(ORDERS, null, $name_order, $date_order, $email_order, $phone_order,$allSum_order, $allQuant_order, $inform_order, null, null));
            if ($add) {
             $dell = mysqli_query($link, $query->deleteTable(NEW_USER));
             if ($dell)  {
                header("Location:./../E-Shop.php?page=orderSend");     
             }
            }           
    } else {
        header("Location:./../E-Shop.php?page=cart&status_order=fields"); 
    }
}
?>