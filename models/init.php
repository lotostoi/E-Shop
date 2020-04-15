<?php
include "config.php";
include "Main.class.php";

$db = new DB;
$db->setOptionsDB(SERVNAME, USERNAME, PASSWORD, DBNAME);
$link = $db->link;
$query = $db->query;
?>