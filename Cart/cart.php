<div class="contCartProducts__bodyCart">
    <?php



    $find_id = $db->find_el_table(USERS, 'id', $_SESSION['id_user']);

    $newArr =  $db->getArrIdRows(CART, 'id_user', $_SESSION['id_user']);
    foreach ($newArr as $key => $val) {
        $res = mysqli_query($link, $query->select_row_id($val, CART));
        $str = mysqli_fetch_assoc($res);
        $quant = $str['quantity'];
        $id = $str['id_product'];
        $res_pr = mysqli_fetch_assoc(mysqli_query($link, $query->select_row_id($id, COTALOG)));
        $name_cart = $res_pr['name'];
        $price_cart = $res_pr['price'];
        $link_img_cart = $res_pr['linkImg'];
        $allQuant += $quant;
        $allPrice += $quant * $price_cart;
    ?>
        <div class="contCartProducts__contItem">
            <img src="<?= $link_img_cart ?>" width="100" height="150" alt="imgProduct" class="contCartProducts__img">
            <span class="contCartProducts__name"><?= $name_cart ?></span>
            <span class="contCartProducts__price" data-price="<?= $price_cart ?>" data-priceId="<?= $id ?>">$<?= $price_cart * $quant ?></span>
            <span class="contCartProducts__quantity" data-quant="<?= $quant ?>" data-quantId="<?= $id ?>"><?= $quant ?> шт</span>
            <div class="contCartProducts__buttons">
                <button @click="$parent.addItemInCart(prod)" data-userid="<?= $_SESSION['id_user'] ?>" data-id="<?= $id ?>" class="contCartProducts__add">&#9650</button>
                <button @click="$parent.delItemInCart(prod)" data-userid="<?= $_SESSION['id_user'] ?>" data-id="<?= $id ?>" class="contCartProducts__del">&#9660</button>
            </div>
        </div>
    <?php
    }

    ?>
    <div class="contCartProducts__rethult">
        <span class="contCartProducts__span">Итого:</span>
        <span class="contCartProducts__allSumm">$ <?= $allPrice ? $allPrice : 0 ?> </span>
        <span class="contCartProducts__allQuantity"> <?= $allQuant ? $allQuant : 0 ?> шт</span>
        <button class="contCartProducts__allClean" data-userid="<?= $_SESSION['id_user'] ?>">
            Очистить корзину
        </button>
    </div>
    <?php
    if ($find_id['flag']) {
        include "./makeOrder/vue_makeOrderYesRegUser.php";
    } else {
        include "./makeOrder/vue_makeOrderNoRegUser.php";
    } ?>

</div>

<script src="./Cart/js/cart.js">

</script>