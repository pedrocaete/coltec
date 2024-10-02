<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../../classes/user/UserInfo.php";

$user = new UserInfo();

require 'remove.html';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remover'])) {
$user->remove();
header('Location: ../register/register.php');
}

