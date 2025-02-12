<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../../classes/user/UserDAO.php";

require 'remove_users.html';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remover'])) {
    $email = $_POST['email'];
    UserDAO::remove($email);
}
