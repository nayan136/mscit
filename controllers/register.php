<?php
require_once '../core/init.php';

$db = new User();
$email = strtolower($_POST["email"]);
$password = $_POST["password"];
$name = strtolower($_POST["name"]);
$address = strtolower($_POST["address"]);
$city = strtolower($_POST["city"]);
$state = strtolower($_POST["state"]);
$contact = $_POST["contact"];
$gender = $_POST["gender"];
$role = $_POST["role"];
$skill = strtolower($_POST["skill"]);
$dob = $_POST["dob"];

if($role == CANDIDATE){
    $active = 1;
}else{
    $active = 0;
}

$array = [$email,$password,$name,$address,$city,$state,$contact,$gender,$active,$role,$skill,$dob];
$result = $db->register($array);
echo checkStatus($result,null,"email already exist");
//  echo json_encode($array);