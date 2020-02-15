<?php
// если нажата кнопка редактировать или отправлен запрос на редктирование
if (isset($_POST['persAreaEdit']) || isset($_GET['persAreaEdit'])) {
    include "vue_persAreaEdit.php";
} elseif (isset($_POST['persAreaSave'])) {
    if ($_POST['login_persArea'] != '' && $_POST['name_persArea'] != '') {
        $login = "'" . $_POST['login_persArea'] . "'";
        $name = "'" . $_POST['name_persArea'] . "'";
        $password = "'" . md5($_POST['pas1_persArea']) . "'";
        $email = "'" . $_POST['email_persArea'] . "'";
        $phone = "'" . $_POST['phone_persArea'] . "'";
        // если меняем пароль
        if ($_POST['pas1_persArea']!='' || $_POST['pas2_persArea']!='') {
            //если пароли равны
            if ($_POST['pas1_persArea'] === $_POST['pas2_persArea']) {
                $resp = $query->updateRow_5(USERS, $_SESSION['id_user'], 'login', $login, 'name', $name, 'password',  $password, 'email', $email, 'phone', $phone);
                mysqli_query($link, $resp);
                session_destroy();
                header("Location: E-Shop.php?page=entrance&status_entrance=1");
                // если пароли не равны
            } else {
                header("Location: E-Shop.php?page=persArea&persAreaEdit=1&status_editPersData=pass");
            }
            //если пароли не меняем
        } else {
            $resp = $query->updateRow_4(USERS, $_SESSION['id_user'], 'login', $login, 'name', $name, 'email', $email, 'phone', $phone);
            mysqli_query($link, $resp);
            session_destroy();
            header("Location: E-Shop.php?page=entrance&status_entrance=1"); 
        }
    }
   // внешний вид по умолчанию
} else {
    include "vue_persArea.php";
}
?>