<?php
require_once '../../core/init.php';

$postName = $_POST['name'];
$userId = $_POST['user_id'];
$postDetails = $_POST['post_details'];
$postSkill = $_POST['post_skill'];
$postCity = $_POST['city'];
$postExperience = $_POST['experience'];
$endDate  = $_POST['end_date'];

$today = Date::today();

$array = [$postName,$userId,$postDetails,$postSkill,$postCity,$postExperience,$today,$endDate];

$db = new Post();
$result = $db->store($array);
echo checkStatus($result);

