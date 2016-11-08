<?php


$db = new Conection();
$db->get_conection();
include (HTML_DIR.'index/index.php');
$db->close();