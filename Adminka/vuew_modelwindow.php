<?php
include "./../init.php";
?>

<div class="modelWindow">
    <div class="modelWindow__window">
        <?php

        $orders = $db->getArr(ORDERS);

        foreach ($orders as $key => $val) {
            $id_order = $val['id'];
            $name_order = $val['name_user'];
            $email_order = $val['e-mail'];
            $phone_order = $val['phone'];
            $date_order = $val['date'];
            $text_order = $val['desc'] /* != 0 ?  $val['desc'] : '' */;
            $inf_order = $val['informOrder'];
            $allSum = $val['allSum'];
            $allQuant = $val['allQuant'];
            // echo $inf_order;

        ?>

            <div data-idwin="<?= $id_order ?>" class="modelWindow__show">
                <?php
                $arrIdProduct = [];
                $arrQuantProduct = [];
                // получаем массив c id-ками продуктов
                preg_match_all('/\"id\_product\"\:\"[0-9]+\"/i', $inf_order, $arrIdProduct, PREG_PATTERN_ORDER);
                $str_id = implode('', $arrIdProduct[0]);
                preg_match_all('/[0-9]+/i', $str_id, $arr_id, PREG_PATTERN_ORDER);
                // получаем массив c количеством продуктов
                preg_match_all('/\"quantity\"\:\"[0-9]+\"/i', $inf_order, $arrQuantProduct, PREG_PATTERN_ORDER);
                $str_quant = implode('', $arrQuantProduct[0]);
                preg_match_all('/[0-9]+/i', $str_quant, $arr_quant, PREG_PATTERN_ORDER);
                // формируем общий массив
                foreach ($arr_id[0] as $key => $val) {
                 //   echo $val;
                    $orderArr[$key] = ['id_product' => $val, 'quant' => $arr_quant[0][$key]];
                }

                ?>

                <button class="modelWindow__close">X</button>
                <h3 class="modelWindow__h3">Информация о заказе!</h3>

                <label class="modelWindow__fields">
                    <span class="modelWindow__titelid">id заказа:</span>
                    <span class="modelWindow__valid"><?= $id_order ?></span>
                </label>
                <label class="modelWindow__fields">
                    <span class="modelWindow__titelid">Заказчик:</span>
                    <span class="modelWindow__valid"><?= $name_order ?></span>
                </label>
                <label class="modelWindow__fields">
                    <span class="modelWindow__titelid">Телефон:</span>
                    <span class="modelWindow__valid"><?= $phone_order ?></span>
                </label>
                <label class="modelWindow__fields">
                    <span class="modelWindow__titelid">Email:</span>
                    <span class="modelWindow__valid"><?= $email_order ?></span>
                </label>
                <label class="modelWindow__fields">
                    <span class="modelWindow__titelid">Дата:</span>
                    <span class="modelWindow__valid"><?= $date_order ?> </span>
                </label>
                <label class="modelWindow__fields">
                    <span class="modelWindow__titelid">Сообщение:</span>
                    <span class="modelWindow__valid"><?= $text_order ?></span>
                </label>

                <p class="modelWindow__h3">Заказ:</p>

                <?php

                foreach ($orderArr as $key => $val) {

                    $id_product = $val['id_product'];
                    $id_quant = $val['quant'];
                    $product = $db->getArrRows(COTALOG, 'id', $id_product)[0];

                ?>
                    <div class="modelWindow__orderCont">
                        <img src="<?= $product['linkImg'] ?>" alt="" class="modelWindow__imgProduct">
                        <span class="modelWindow__nameProduct"> <?= $product['name'] ?> </span>
                        <span class="modelWindow__quantProduct"><?= $id_quant ?> шт.</span>
                        <span class="modelWindow__priceProduct"> $ <?= $id_quant * $product['price'] ?> </span>
                    </div>
                <?php
                }
                $orderArr = [];
                ?>

                <div class="modelWindow__orderCont">
                    <span class="modelWindow__nameProduct"> Итого: </span>
                    <span class="modelWindow__priceProduct"> $<?= $allSum ?> </span>
                    <!-- <span class="modelWindow__quantProduct"> 5</span> -->
                </div>
            </div>

        <?php } ?>
    </div>
</div>