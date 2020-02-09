<form class="entrance" method="POST" action="./controllers/contr_reg.php">
    <label class="entrance__login">Логин: <input type="text" name="login_reg" value="<?= $login_reg ?>"></label>
    <label class="entrance__login">Ваше имя: <input type="text" name="name_reg" value="<?= $name_reg ?>"></label>
    <label class="entrance__login">Пароль: <input type="password" name="password_reg_1" value="<?= $pas_reg_1 ?>"></label>
    <label class="entrance__login">Подтвердите пароль: <input type="password" name="password_reg_2" value="<?= $pas_reg_2 ?>"></label>
    <label class="entrance__login">E-mail: <input type="email" name="email" value="<?= $email_reg ?>"></label>
    <label class="entrance__login">Телефон: <input type="phone" name="phone" value="<?= $phone_reg ?>"></label>
    <input type="submit" name="reg" value="Регистрация" class="entrance__btn">
    <?php
    switch ($_GET['status_reg']) {
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