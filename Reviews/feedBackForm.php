<?php
$sendReview = $_POST['sendReview'];
// данные для соеденения с базой данных.
$nameServer = "localhost";
$nameUserDB = "root";
$nameDB = "shop_e";
$nameTable = "reviews";

// поля отзыва
$nameUser = $_POST['nameUser'];
$dateUser = date('Y-m-d h:i:s');
$emailUser = $_POST['emailUser'];
$phoneUser = $_POST['phoneUser'];
$textUser = $_POST['textUser'];

if ($textUser != ""  &&  $nameUser != ""  &&  $nameDB != "") {

    $link = mysqli_connect($nameServer, $nameUserDB, "", $nameDB);
    if (!$link) die('Ошибка подключения к серверу баз данных.');

    $res = mysqli_query($link, $query->addOneRow_6($nameTable, null, $nameUser, $dateUser, $emailUser, $phoneUser, $textUser));

    if (!$res) die('Ошибка: ' . mysqli_error($link));
    mysqli_close($link);
}

$link = mysqli_connect($nameServer, $nameUserDB, "", $nameDB);
if (!$link) die('Ошибка подключения к серверу баз данных.');

$strReviews = '';

$result = mysqli_query($link, $query->sort_max_min($nameTable, "data"));
while ($val = mysqli_fetch_assoc($result)) {
    $name = $val['name'];
    $data =  $val['data'];
    $text = $val['text'];
    $strReviews .= "
        <div class='reviews__review'>
        <span class='reviews__nameUser'> $name </span>
        <p class='reviews__text'>$text.</p>
        <span class='reviews__data'> $data </span>
        </div>";
}
$nameUser = "";
$dateUser = "";
$emailUser = "";
$phoneUser = "";
$textUser = "";


mysqli_close($link);

?>

<form  method="POST" class="writeReview">
    <h1 class="writeReview__h1"> Пожалуйста оставте отзыв о нашем сайте! </h1>
    <label for="#" class="writeReview__user"> Ваше имя:
        <input type="text" name="nameUser" class="writeReview__nameUser">
    </label>
    <label for="#" class="writeReview__user"> Вашь e-mail:
        <input type="email" name="emailUser" class="writeReview__emailUser">
    </label>
    <label for="#" class="writeReview__user"> Вашь телефон:
        <input type="text" name="phoneUser" class="writeReview__phoneUser">
    </label>
    <label for="#" class="writeReview__user">
        <textarea name="textUser" class="writeReview__textUser" cols="30" rows="10"></textarea>
    </label>
    <input type="submit" name="sendReview" value="Отправить отзыв" class="writeReview__sendData">
</form>

<section class="reviews">
<?php 
echo $strReviews;
?>
</section>