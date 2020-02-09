<div class="editDB">

    <form class="editDB__form" method="POST">
        <div class="editDB__contBut">
            <button type="submit" name="getCotalog" class="editDB__inputBtn"> Редактировать каталог </button>
           <!--  <button type="submit" name="getReviews" class="editDB__inputBtn"> Редактировать отзывы </button> -->

        </div>

        <?php
        if (isset($_POST['addProduct']) && isset($_POST['namberProducts'])) {
            for ($i = 1; $i <= $_POST['namberProducts']; $i++) { ?>
                <div class='contItem'>
                    <div class='contItem__left'>
                        <label class='contItem__label'>№
                            <span><?= $i ?></span>
                        </label>
                        <label class='contItem__label'>Имя продуката
                            <input type='text' name='name-<?= $i ?>' class='contItem__inp' value=''>
                        </label>
                        <label class='contItem__label'>Цена продукта
                            <input type='text' name='price-<?= $i ?>' class='contItem__inp' value=''>
                        </label>
                        <label class='contItem__label'>Ссылка на изображение</span>
                            <input type='text' data-link='<?= $i ?>' name='link-<?= $i ?>' class='contItem__inp' value=''>
                            <p data-id='<?= $i ?>' class='contItem__a'> Обновить изображение </p>
                        </label>
                        <textarea name='desc-<?= $i ?>' class='contItem__inpText' value='$desc_cot'> </textarea>
                    </div>
                    <div class='contItem__right' data-contimg='<?= $i ?>'>
                        <img src='$link_cot' alt='img' class='contItem__img' height='300'>
                    </div>
                </div>;
            <?php
            }
            ?>
            <div class='editDB__contSave'>
                <label class='editDB__nuberProduct'>
                    <button type='submit' name='addsaveChenges' class='editDB__SaveChange'> Сохранить изменения </button>
                </label>

            </div>
            <?php
        }

        if (isset($_POST['addsaveChenges'])) {


            foreach ($_POST as $key => $val) {
                $str .= $key . " ";
            }

            //   preg_match_all('/ID\-[0-9]+/i', $str, $arr_id, PREG_PATTERN_ORDER);
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



        if (isset($_POST['getCotalog'])) {

            $arr = getArr($link, COTALOG);

            foreach ($arr as $key => $val) {
                $id_cot = $val['id'];
                $name_cot = $val['name'];
                $price_cot = $val['price'];
                $link_cot = $val['linkImg'];
                $desc_cot = $val['description'];


            ?>
                <div class='contItem'>
                    <div class='contItem__left'>
                        <label class='contItem__label'>ID продукта
                            <span><?= $id_cot ?></span>
                            <input type="hidden" name="ID-<?= $id_cot ?>" value="<?= $id_cot ?>">
                        </label>
                        <label class='contItem__label'>Имя продуката
                            <input type='text' name='name-<?= $id_cot ?>' class='contItem__inp' value='<?= $name_cot ?>'>
                        </label>
                        <label class='contItem__label'>Цена продукта
                            <input type='text' name='price-<?= $id_cot ?>' class='contItem__inp' value='<?= $price_cot ?>'>
                        </label>
                        <label class='contItem__label'>Ссылка на изображение</span>
                            <input type='text' data-link='<?= $id_cot ?>' name='link-<?= $id_cot ?>' class='contItem__inp' value='<?= $link_cot ?>'>
                            <p data-id='<?=$id_cot?>' class='contItem__a'> Обновить изображение </p>
                        </label>
                        <textarea name='desc-<?= $id_cot ?>' class='contItem__inpText' value='<?= $desc_cot ?>'> <?= $desc_cot ?> </textarea>
                        <label class='contItem__lebDell'>
                            <div>Удалить товар</div>
                            <input type='checkbox' name='dell-<?= $id_cot ?>' class='contItem__inpDel' value=''>
                        </label>
                    </div>
                    <div class='contItem__right' data-contimg='<?= $id_cot ?>'>
                        <img src='<?= $link_cot ?>' alt='img' class='contItem__img' height='300'>
                    </div>
                </div>
            <?php
            }
            ?> <div class='editDB__contSave'>
                <label class='editDB__nuberProduct'>
                    <button type='submit' name='saveChenges' class='editDB__SaveChange'> Сохранить изменения </button>
                    <span>Количество</span>
                    <input type='text' name='namberProducts' class='editDB__numbInp' value='1'>
                    <button type='submit' name='addProduct' class='editDB__addProd'> Добавить новый товар </button>
                </label>

            </div>
        <?php
        }

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