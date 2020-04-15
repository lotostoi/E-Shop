<?php
$user = $db->getArrRows(USERS, 'id', $_SESSION['id_user'])[0];
?>

<form class="persArea" method="POST">
    <h3 class="persArea__h3"> Личный кабинет </h3>

    <label class="persArea__label">
        <span class="persArea__title">Логин:</span>
        <span class="persArea__value"><?= $user['login'] ?> </span>
    </label>
    <label class="persArea__label">
        <span class="persArea__title">Имя:</span>
        <span class="persArea__value"><?= $user['name'] ?> </span>
    </label>
    <label class="persArea__label">
        <span class="persArea__title">E-mail:</span>
        <span class="persArea__value"><?= $user['email'] ?> </span>
    </label>
    <label class="persArea__label">
        <span class="persArea__title">Телефон:</span>
        <span class="persArea__value"><?= $user['phone'] ?> </span>
    </label>

    <button type="submit" class="persArea__btnEdit" name="persAreaEdit"> Изменить </button>


</form>