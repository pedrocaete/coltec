<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "User.php";

session_start();
$user = User::unserialize($_SESSION['User']);

require '../html/remove_user.html';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remover'])) {
$user->remove();
header('Location: cadastro.php');
}
