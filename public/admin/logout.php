<?php
require_once '../../core/init.php';

Session::destroy();
header("Location: ../login.php");