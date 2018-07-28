<?php

require_once '../core/init.php';

$db = new Education();
$result = $db->index();
echo checkStatus($result);