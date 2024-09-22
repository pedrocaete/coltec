<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "User.php";

session_start();
$user = User::unserialize($_SESSION['User']);
echo $user->email . '<br>' .$user->birth . '<br>' . $user->username . '<br>';

require '../html/user_info.html';
