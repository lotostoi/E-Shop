<?php 

if (!isset($_SESSION['id_user'])) {
    $arr_users = getArr($link, USERS);
    $max_id_user = $arr_users[count($arr_users)-1]['id'];
    $_SESSION['id_user'] = $max_id_user + 1;
    $flag = true; 
  
}



?>


<div class="contProduct">
    <img src="<?= $_GET['link'] ?>" alt='img' class='imgProduct'>
    <h3 class="nameProduct"> <?= $_GET['name'] ?> </h3>
    <span class='priceProduct'> $ <?= $_GET['price'] ?> </span>
    <p class="textProduct"><?= $_GET['text'] ?></p>
    <button class="btnAddToCart"> Добавить в корзину </button>
</div>

<script>
    document.querySelector('.btnAddToCart').addEventListener('click', function() {
        let params = new FormData();
        params.append('id_product', <?= $_GET['page'] ?>)
        params.append('id_user', "<?= $_SESSION['id_user'] ? $_SESSION['id_user'] : $_SESSION['id_user'] = 'new_user' ?>")
        params.append('oper', 'add')
        fetch('server.php', {
                method: 'post',
                body: params
            })
            .then(data => data.json())
            .then((data) => {
                if (data.res == "add") {
                    document.querySelector('.countCart').innerHTML = data.allQuant
                }


            })
    })
</script>