<div class='order'>
 
    <form class="makeOrder" method="POST" action="./makeOrder/contr_makeOrderNoRegUser.php">
        <label class="makeOrder__login">Ваше имя: <input type="text" name="name_order" value="<?= $name_order ?>"></label>
        <label class="makeOrder__login">Телефон: <input type="text" name="phone_order" value="<?= $phone_order ?>"></label>
        <label class="makeOrder__login">E-mail: <input type="email" name="email_order" value="<?= $email_order ?>"></label>
        <label class="makeOrder__text">Пожелания к заказу: <textarea type="text" name="text_order"> <?= $text_order ?></textarea></label>
        <input type="submit" name="makeOrder" value="Сделать заказ" class="makeOrder__btn">
        <input type="hidden" name="id_user" value="<?=$_SESSION['id_user']?>">
        <?php
        if ($_GET['status_order']) { ?>
            <div class='entrance__errText'>
                <p class='entrance__err'> Все поля должны быть заполнены!</p>
            </div>
        <?php
        }
        ?>
    </form>
</div>