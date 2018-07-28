<?php
require_once '../../core/init.php';

$userId = $_GET["user_id"];

$db = new ApplyPost();
$result = $db->applyList($userId);
echo checkStatus($result);