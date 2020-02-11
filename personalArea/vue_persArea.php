<form class="persArea" action="contr_persArea.php" method="POST">
    <h3 class="persArea__h3"> Личный кабинет </h3>

    <label class="persArea__label">
        <span class="persArea__title">Логин:</span> 
        <span class="persArea__value"><?=$_GET['login']?> </span> 
    </label>
    <label class="persArea__label">
        <span class="persArea__title">Имя:</span> 
        <span class="persArea__value"><?=$_GET['name']?> </span> 
    </label>
    <label class="persArea__label">
        <span class="persArea__title">E-mail:</span> 
        <span class="persArea__value"><?=$_GET['email']?> </span> 
    </label>
    <label class="persArea__label">
        <span class="persArea__title">Телефон:</span> 
        <span class="persArea__value"><?=$_GET['phone']?> </span> 
    </label>

    <button type="submit" class="persArea__btnEdit" name="persAreaEdit"> Редктировать личные данные </button>

</form>