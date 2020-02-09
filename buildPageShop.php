<?php

$nametabel = "cotalog";

if (!$link) die('Ошибка подключения к серверу баз данных.');
$list = "";
$products = mysqli_query($link, $query->selectAll($nametabel));
while ($product = mysqli_fetch_assoc($products)) {
    $id = $product['id'];
    $name = $product['name'];
    $path = $product['linkImg'];
    $price = $product['price'];
    $text = $product['description'];

    $list .=  "<div class='cotalog__product'>";
    $list .= "<a href='E-Shop.php?page=$id&name=$name&link=$path&price=$price&text=$text' data-id='$id' class='cotalog__nameProduct'> 
                <img src='$path' alt='img' class='cotalog__img' width='100' height ='190'>    
            </a>";
    $list .= "<a href='E-Shop.php?page=$id&name=$name&link=$path&price=$price&text=$text' data-id='$id' class='cotalog__nameProduct'> $name </a>";
    $list .= "<span class='cotalog__priceProduct'>$ $price</span>";
    $list .= "<button data-id='$id' class='cotalog__addCart'>Добавить в корзину</button>";
    $list .= "</div>";
}
echo $list;
?>
