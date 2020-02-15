<div class="contOrders">
    <?php
    foreach ($orders as $key => $val) {
    ?>
        <div class="contOrder">
            <span class="id_orderTitle">ID заказа: </span> <span class="id_orderValue"><?= $val['id'] ?></span>
            <span class="name_orderTitle">Заказчик: </span> <span class="name_orderValue"><?= $val['name_user'] ?></span>
            <span class="data_orderTitle">Дата : </span> <span class="data_orderValue"><?= $val['date'] ?></span>
            <span class="allsum_orderTitle">Cумма заказа: </span> <span class="allsum_orderValue"><?= $val['allSum'] ?></span>
            <div class="watchOrder" data-id="<?= $val['id'] ?>"> Подробная информация о заказе </div>
        </div>

    <?php
    }
    ?>
</div>

<script>


</script>