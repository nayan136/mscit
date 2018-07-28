<?php
require_once '../../core/init.php';

$db  = new CandidateEducation();
$userId = $_GET["user_id"];

$result = $db->index($userId);
echo checkStatus($result);