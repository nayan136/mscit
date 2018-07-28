<?php
require_once '../../core/init.php';

$id = $_POST["education_id"];

$db = new CandidateEducation();
$result = $db->delete($id);
echo checkStatus($result);