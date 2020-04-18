<?php
$nametabel = "cotalog";
$products = $db->getArr($nametabel);
?>
<?php
foreach ($products as $key => $value) {
?>
    <div class='cotalog__product'>
        <a href='E-Shop.php?page=<?= $value['id'] ?>&name=<?= $value['name']?>&link=<?= $value['linkImg'] ?>&price=<?= $value['price'] ?>&text=<?= $value['description'] ?>' data-id='<?= $value['id'] ?>' class='cotalog__nameProduct'>
            <img src='<?= $value['linkImg'] ?>' alt='<?= $value['name'] ?>' class='cotalog__img' width='100' height='190'>
        </a>
        <a href='E-Shop.php?page=<?= $value['id'] ?>&name=<?= $value['name'] ?>&link=<?= $value['linkImg'] ?>&price=<?= $value['price'] ?>&text=<?= $value['description'] ?>' data-id='<?= $value['id'] ?>' class='cotalog__nameProduct'> <?= $value['name'] ?> </a>
        <span class='cotalog__priceProduct'>$ <?= $value['price'] ?></span>
        <button data-id='<?= $value['id'] ?>' class='cotalog__addCart'>Добавить в корзину</button>

    </div>
<?php } ?>






