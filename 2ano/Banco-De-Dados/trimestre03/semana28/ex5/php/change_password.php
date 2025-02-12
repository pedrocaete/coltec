<?php
require '../html/change_password.html';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "User.php";

if (isset($_POST['submit'])) {
    session_start();
    $user = User::unserialize($_SESSION['User']);
    if ( $user->changePassword() ){
        header('Location: user_info.php');
    }
}
