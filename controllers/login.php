<?php

require_once '../core/init.php';

$db = new User();
$email = $_POST["email"];
$password = $_POST["password"];
$result = $db->login($email, $password);
echo checkStatus($result,"username or password mismatched");