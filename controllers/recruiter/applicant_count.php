<?php
require_once '../../core/init.php';

$postId = $_GET["post_id"];
$db = new ApplyPost();
$result = $db->applicantCount($postId);
echo checkStatus($result);