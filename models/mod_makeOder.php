<?php 
function getJsonTable_newUser($link) {
 $arrTabel = getArr($link,NEW_USER); 
 return json_encode($arrTabel);
}
?>