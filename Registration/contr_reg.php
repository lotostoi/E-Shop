<?php
include "./../models/init.php";
$login_reg = $_POST['login_reg'];
$name_reg = $_POST['name_reg'];
$pas_reg_1 = $_POST['password_reg_1'];
$pas_reg_2 = $_POST['password_reg_2'];
$email_reg = $_POST['email'];
$phone_reg = $_POST['phone'];
$status = 'User';

if (isset($_POST['reg'])) {
    if ($login_reg != '' && $name_reg != '' && $pas_reg_1 != '' && $pas_reg_2 != '' && $email_reg != '' && $phone_reg != '') {

        $login = $db->find_el_table(USERS, 'login', $login_reg);
        $email = $db->find_el_table(USERS, 'email', $email_reg);

        if (!$login['flag']) {
            if (!$email['flag']) {
                if ($pas_reg_1 === $pas_reg_2) {
                    mysqli_query($link, $query->addOneRow_7(USERS, null, $login_reg, $name_reg, md5($pas_reg_1), $status, $email_reg, $phone_reg));
                    header("Location: ./../E-Shop.php?page=entrance");
                } else {
                    header("Location: ./../E-Shop.php?page=reg&status_reg=pass");
                }
            } else {
                header("Location: ./../E-Shop.php?page=reg&status_reg=email");
            }
        } else {
            header("Location: ./../E-Shop.php?page=reg&status_reg=login");
        }
    } else {
        header("Location: ./../E-Shop.php?page=reg&status_reg=fields");
    }
}
