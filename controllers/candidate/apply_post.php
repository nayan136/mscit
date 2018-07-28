<?php
require_once '../../core/init.php';

$userId = $_POST["user_id"];
$postId = $_POST["post_id"];

$array = [$userId, $postId, Date::today()];

$db = new ApplyPost();
$result = $db->apply($array);
echo checkStatus($result);