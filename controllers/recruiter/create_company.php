<?php
require_once '../../core/init.php';

$userId = $_POST["user_id"];
$name = $_POST["name"];
$description = $_POST["description"];
$type = $_POST["type"];
$contact = $_POST["contact"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];

$array = [$name,$description,$type,$contact,$address,$city,$state];

$company = new Company();
$result = $company->store($array);
$status = $result["code"];
$data = $result["data"];
if($status == OK){
    $db = new UserCompany();
    echo checkStatus($db->store([$userId,$data[0]]));
}
