<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "../../classes/user/UserInfo.php";
require_once "../../classes/user/UserDAO.php";
require_once "../../classes/Form.php";

require 'change_status_user.html';

$email = Form::getEmail();
$newStatus = Form::getNewStatus();

$newStatus == "ativo" ? UserDAO::activate($email) : UserDAO::desactivate($email);
