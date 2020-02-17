<?php
session_start();
if (isset($_SESSION['user'])) {
    $text =  '<div><input type="submit" name="exit" value="Выйти" class="entrance__btn">';
} else if (!isset($_SESSION['user'])) {
    $text =  '<input type="submit" name="entrance" value="Войти" class="entrance__btn">';
}
if (isset($_COOKIE['login'])) {
    $login = $_COOKIE['login'];
    $password = $_COOKIE['password'];
}


if (!isset($_SESSION['user'])  && isset($_POST['entrance']) && isset($_POST['login']) && isset($_POST['password'])) {
    // провека есть ли логин в базе данных и под каким он номером

    $arr = getArrPole($link, USERS, 'login');
    foreach ($arr as $key => $val) {
        if ($val == $_POST['login']) {
            $flag = true;
            $index = $key;
        }
    };

    $login = $_POST['login'];
   // echo $_POST['password'];
    $password = md5($_POST['password']);

    if ($flag) {
        $pas = getArr($link, USERS)[$index]['password'];
        if ($pas ==  $password) {
            setcookie("login", $_POST['login'], time() + 3600 * 24 * 365);
            setcookie("password", $password, time() + 3600 * 24 * 365);
            $_SESSION['user'] = $_POST['login'];
            $_SESSION['id_user'] = getArr($link, USERS)[$index]['id'];
            $_SESSION['status_user'] = getArr($link, USERS)[$index]['status'];
            header("Location:E-Shop.php?page=main");
        } else {
            $text .= " <div class='entrance__errText'> <p class='entrance__err'> Неверный логин или пароль! </p> </div>";
        }
    } else {
        $text .= " <div class='entrance__errText'> <p class='entrance__err'> Неверный логин или пароль! </p> </div>";
    }
}
?>
<form class="entrance" method="POST">
    <?php
    if ($_GET['status_entrance']) { ?>
        <div class='entrance__okText'>
            <p class='entrance__err'> Личные данные успешно изменены, для продолжения работы введите логин и пароль. </p>
        </div>
    <?php
    }
    ?>
    <label class="entrance__login">Логин <input type="text" name="login" value="<?= $login ?>"></label>
    <label class="entrance__login">Пароль <input type="password" name="password" value="<?= $password ?>"></label>
    <?php echo  $text ?>
</form>