<?php
require "../html/cadastro.html";

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "User.php";

if (isset($_POST['submit'])) {
    $user = new User();
    $user->getRegisterData();
    if ($user->register()){
        header('Location: user_info.php');
    }
}
