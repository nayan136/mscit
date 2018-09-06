<?php
require_once '../core/init.php';

$company = new Company();

$userId = $_GET["user_id"];
echo checkStatus($company->companyByUser($userId));
