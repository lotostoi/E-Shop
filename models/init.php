<?php
include "config.php";
include "Main.class.php";

$db = DB::getInstance();
$db->setOptionsDB(SERVNAME, USERNAME, PASSWORD, DBNAME);
$link = $db->link;
$query = $db;

