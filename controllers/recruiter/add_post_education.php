<?php
require_once '../../core/init.php';

$postId = $_POST["post_id"];
$name = $_POST["name"];
$department = $_POST["department"];
$percentage = $_POST["percentage"];

$array = [$postId,$name,$department,$percentage];

$db = new PostEducation();
$result = $db->store($array);
echo checkStatus($result);