<?php
if ($_POST['name_persArea'] == '' && $_POST['login_persArea'] == '') {
    $user = getArrRows($link, USERS, 'id', $_SESSION['id_user'])[0];
    $login_pers = $user['login'];
    $name_pers = $user['name'];
    $pas1_pers = '';
    $pas2_pers = '';
    $email_pers = $user['email'];
    $phone_pers = $user['phone'];
}

?>

<form class="persArea" method="POST">
    <h3 class="persArea__h3"> Редактировать личные данные </h3>

    <label class="persArea__label">
        <span class="persArea__title">Логин:</span>
        <input class="persArea__input" type="text" name="login_persArea" value="<?= $user['login'] ?>">
    </label>
    <label class="persArea__label">
        <span class="persArea__title">Имя:</span>
        <input class="persArea__input" type="text" name="name_persArea" value="<?= $user['name'] ?>">
    </label>
    <label class="persArea__label">
        <span class="persArea__title"> Новый пароль:</span>
        <input class="persArea__input" type="password" name="pas1_persArea" value="">
    </label>
    <label class="persArea__label">
        <span class="persArea__title"> Повторите пароль:</span>
        <input class="persArea__input" type="password" name="pas2_persArea" value="">
    </label>
    <label class="persArea__label">
        <span class="persArea__title">E-mail:</span>
        <input class="persArea__input" type="text" name="email_persArea" value="<?= $user['email'] ?>">
    </label>
    <label class="persArea__label">
        <span class="persArea__title">Телефон:</span>
        <input class="persArea__input" type="text" name="phone_persArea" value="<?= $user['phone'] ?>">
    </label>

    <button type="submit" class="persArea__btnEdit" name="persAreaSave"> Изменить </button>

    <?php
    switch ($_GET['status_editPersData']) {
        case "good": ?>
            <div class='entrance__okText'>
                <p class='entrance__err'> Вы успешно зарегестрированны!</p>
            </div>
        <?php
            break;
        case "pass": ?>
            <div class='entrance__errText'>
                <p class='entrance__err'> Пароли не совпадают</p>
            </div>
        <?php
            break;
        case "email": ?>
            <div class='entrance__okText'>
                <p class='entrance__err'> Данный e-mail уже ипользуется</p>
            </div>
        <?php
            break;
        case "login": ?>
            <div class='entrance__okText'>
                <p class='entrance__err'> Логин занят!</p>
            </div>
        <?php
            break;
        case "fields": ?>
            <div class='entrance__okText'>
                <p class='entrance__err'> Все поля должны быть заполнены!</p>
            </div>
    <?php
            break;
    }
    ?>

</form>