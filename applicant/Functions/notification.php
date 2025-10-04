<?php   
require "../../connection/dbcon.php";


header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

$user_id = 123;