<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../../classes/user/UserInfo.php";

$user = new UserInfo();

require 'alter_data.html';

if ($user->alterData()) {
    header('Location: info.php');
}
