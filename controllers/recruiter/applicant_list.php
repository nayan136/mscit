<?php
require_once '../../core/init.php';

$postId = $_GET["post_id"];

$db = new User();
$result = $db->applicantList($postId);
echo checkStatus($result);
