<?php
require 'change_password.html';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../../classes/user/UserInfo.php";

if (isset($_POST['submit'])) {
    $user = new UserInfo();
    if ( $user->changePassword() ){
        header('Location: info.php');
    }
}
