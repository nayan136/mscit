<?php
require_once '../../core/init.php';

$userId = $_GET["user_id"];

$db = new Post();
$result = $db->recommendedPost($userId);
echo checkStatus($result);