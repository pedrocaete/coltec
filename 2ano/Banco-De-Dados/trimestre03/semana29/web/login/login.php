<?php
require '../login/login.html';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../../classes/user/UserLogin.php";
if (isset($_POST['submit'])) {
    $user = new UserLogin();
    if($user->login()){
        header('Location: ../user_area/info.php');
        exit;
    }
}
