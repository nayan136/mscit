<?php

require_once '../../core/init.php';

$db = new CandidateEducation();
$userId = $_POST["user_id"];
$eduName = $_POST["education_name"];
$department = $_POST["department"];
$instName = $_POST["college_name"];
$year = $_POST["year"];
$percentage = $_POST["percentage"];

$array = [$userId,$eduName,$department,$instName,$year,$percentage];
$result = $db->store($array);
echo checkStatus($result);

