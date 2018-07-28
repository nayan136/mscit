<?php
require_once '../../core/init.php';

$postId = $_GET["post_id"];
$db = new PostEducation();
$result = $db->getEducation($postId);
echo checkStatus($result);