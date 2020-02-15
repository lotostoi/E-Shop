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