<div class="editDB">
    <?php
    include "vuew_modelwindow.php";
    ?>

    <form class="editDB__form" method="POST">
        <div class="editDB__contBut">
            <button type="submit" name="getCotalog" class="editDB__inputBtn"> Редактировать каталог </button>
            <button type="submit" name="lookOrders" class="editDB__inputBtn"> Смотреть заказы </button>
        </div>

        <?php

        // если нажата кнопка добавить продук и укзано число продуктов
        if (isset($_POST['addProduct']) && isset($_POST['namberProducts'])) {
            for ($i = 1; $i <= $_POST['namberProducts']; $i++) {
                include "vuew_addproduct.php";
            }
            include "vuew_saveaddproducts.php";
        }
        // если нажата кнопка сохранить данные о добавленных продуктах
        if (isset($_POST['addsaveChenges'])) {

            foreach ($_POST as $key => $val) {
                $str .= $key . " ";
            }

            preg_match_all('/name\-[0-9]+/i', $str, $arr_name, PREG_PATTERN_ORDER);
            preg_match_all('/price\-[0-9]+/i', $str, $arr_price, PREG_PATTERN_ORDER);
            preg_match_all('/link\-[0-9]+/i', $str, $arr_link, PREG_PATTERN_ORDER);
            preg_match_all('/desc\-[0-9]+/i', $str, $arr_desc, PREG_PATTERN_ORDER);
            preg_match_all('/dell\-[0-9]+/i', $str, $arr_dell, PREG_PATTERN_ORDER);

            $str_del = implode('', $arr_dell[0]);

            preg_match_all('/[0-9]+/i', $str_del, $arr_dell_index, PREG_PATTERN_ORDER);

            for ($i = 0; $i < count($arr_name[0]); $i++) {
                $arr_new_table[$i] = ['id' => $arr_id[0]["$i"], 'name' => $arr_name[0]["$i"], 'price' => $arr_price[0]["$i"], 'link' => $arr_link[0]["$i"], 'desc' => $arr_desc[0]["$i"], 'dell' => ''];
            }

            foreach ($arr_dell_index[0] as $val) {
                $arr_new_table[$val - 1]['dell'] = true;
            }

            foreach ($arr_new_table as $key => $val) {
                if (!$val['dell']) {
                    $name_itog = $_POST[$val['name']];
                    $price_itog = $_POST[$val['price']];
                    $link_itog = $_POST[$val['link']];
                    $desc_itog = $_POST[$val['desc']];
                    mysqli_query($link, $query->addOneRow_5(COTALOG, null, $name_itog, $price_itog, $link_itog, $desc_itog));
                }
            }
            echo "Данные успешно добавлены в базу данных!";
        }
        // если нажата кнопка редктировать коталог
        if (isset($_POST['getCotalog'])) {

            $arr = getArr($link, COTALOG);

            foreach ($arr as $key => $val) {
                $id_cot = $val['id'];
                $name_cot = $val['name'];
                $price_cot = $val['price'];
                $link_cot = $val['linkImg'];
                $desc_cot = $val['description'];
                include "vuew_editcotalog.php";
            }
            include "vuew_saveeditproducts.php";
        }
        // сохранить отредктированный каталог
        if (isset($_POST['saveChenges'])) {


            foreach ($_POST as $key => $val) {
                $str .= $key . " ";
            }

            preg_match_all('/ID\-[0-9]+/i', $str, $arr_id, PREG_PATTERN_ORDER);
            preg_match_all('/name\-[0-9]+/i', $str, $arr_name, PREG_PATTERN_ORDER);
            preg_match_all('/price\-[0-9]+/i', $str, $arr_price, PREG_PATTERN_ORDER);
            preg_match_all('/link\-[0-9]+/i', $str, $arr_link, PREG_PATTERN_ORDER);
            preg_match_all('/desc\-[0-9]+/i', $str, $arr_desc, PREG_PATTERN_ORDER);
            preg_match_all('/dell\-[0-9]+/i', $str, $arr_dell, PREG_PATTERN_ORDER);

            $str_del = implode('', $arr_dell[0]);

            preg_match_all('/[0-9]+/i', $str_del, $arr_dell_index, PREG_PATTERN_ORDER);

            for ($i = 0; $i < count($arr_name[0]); $i++) {
                $arr_new_table[$i] = ['id' => $arr_id[0]["$i"], 'name' => $arr_name[0]["$i"], 'price' => $arr_price[0]["$i"], 'link' => $arr_link[0]["$i"], 'desc' => $arr_desc[0]["$i"], 'dell' => ''];
            }
            foreach ($arr_dell_index[0] as $val) {
                $arr_new_table[$val - 1]['dell'] = true;
            }
            foreach ($arr_new_table as $key => $val) {
                echo $val['dell'];
                if (!$val['dell']) {
                    $name_itog = "'" . $_POST[$val['name']] . "'";
                    $price_itog = "'" . $_POST[$val['price']] . "'";
                    $link_itog = "'" . $_POST[$val['link']] . "'";
                    $desc_itog = "'" . $_POST[$val['desc']] . "'";
                    mysqli_query($link, $query->updateRow_4(COTALOG, $_POST[$val['id']], 'name', "$name_itog", 'price', "$price_itog", 'linkImg', "$link_itog", 'description', $desc_itog));
                } else {
                    mysqli_query($link, $query->dellOneRow($_POST[$val['id']], COTALOG));
                }
            } ?>
            <h3 class='editDB__inform'> Данные в базе данных успешно обновлены!</h3>
        <?php
        }
        if (isset($_POST['lookOrders'])) {
            $orders =  getArrSortData($link, ORDERS, "date");
            include "vuew_showorders.php";
        }
        ?>
    </form>
</div>
<script>
    document.querySelector('.editDB__form').addEventListener('click', (evt) => {

        if (evt.target.className == "contItem__a") {
            let link = document.querySelector(`input[data-link="${evt.target.dataset['id']}"]`).value;

            document.querySelector(`div[data-contImg="${evt.target.dataset['id']}"]`).innerHTML = `
                                        <img src='${link}' alt='img' class='contItem__img'  height = '300'>
                                        `
        }

    })
</script>