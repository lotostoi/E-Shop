<div class='order'>
    <!--  <h3 class='order__h3'>Для оформления заказа необходимо авторизирвароться! </h3> -->
    <form class="makeOrder" method="POST" action="./controllers/contr_makeOrderYesRegUser.php">
        <label class="makeOrder__text">Пожелания к заказу: <textarea type="text" name="text_order"> <?= $text_order ?></textarea></label>
        <input type="submit" name="makeOrder" value="Сделать заказ" class="makeOrder__btn">
        <input type="hidden" name="id_user" value="<?=$_SESSION['id_user']?>">
    </form>
</div>