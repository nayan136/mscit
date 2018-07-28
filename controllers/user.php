<?php
require_once '../core/init.php';

$userId = $_GET["user_id"];

$db = new User();
$result = $db->getUser($userId);
echo checkStatus($result);
