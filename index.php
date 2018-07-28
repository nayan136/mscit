<?php
require_once 'core/init.php';
//$db = new User();
//$result = $db->select()
//            ->orderBy('username','DESC')
//            ->orderBy('id','DESC')
//            ->get();
//print_r($result);

//$db = new User();
//$username = $_POST["username"];
//$password = $_POST["password"];
//$result = $db->register(["username","password"],[$username,$password]);
//return $result;

$db = new User();
$username = $_POST["username"];
$password = $_POST["password"];
$result = $db->login($username, $password);
if($result){
    echo $result;
}else{
    echo "Login Failed";
}


?>