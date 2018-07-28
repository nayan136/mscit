<?php
require_once '../core/init.php';

$userId = $_POST["user_id"];
//$email = strtolower($_POST["email"]);
$password = $_POST["password"];
$name = $_POST["name"];
$address = strtolower($_POST["address"]);
$city = strtolower($_POST["city"]);
$state = strtolower($_POST["state"]);
$contact = $_POST["contact"];
$skill = strtolower($_POST["skill"]);
$dob = $_POST["dob"];

$values = [$password,$name,$address,$city,$state,$contact,$skill,$dob];
$cols = ["password","user_name","user_address","user_city","user_state","user_contact","user_skill","dob"];
$db = new User();
$result = $db->update($cols,$values,$userId);
echo checkStatus($result,null,"email already exist");