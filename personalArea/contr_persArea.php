<?php 
error_reporting(0);
include "dbinit.php";
echo $_SESSION['id_user'] . "fdsgfdg";
$user = getArrRows($link,USERS,'id_user',$_SESSION['id_user']);
$login = $user['login'];
$name = $user['name'];
$email = $user['email'];
$phone = $user['phone'];
print_r($user);

?>