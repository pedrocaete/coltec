<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "User.php";

session_start();
$user = User::unserialize($_SESSION['User']);

require '../html/alter_data.html';

if ($user->alterData()) {
    header('Location: user_info.php');
}
