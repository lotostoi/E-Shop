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
            <p data-id='<?= $id_cot ?>' class='contItem__a'> Обновить изображение </p>
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