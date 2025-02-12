<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "register.html";
require_once "../../classes/user/UserRegister.php";

if (isset($_POST['submit'])) {
    $user = new UserRegister();
    if ($user->register()) {
        header('Location: ../user_area/info.php');
    }
}
