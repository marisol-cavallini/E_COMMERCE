<?php
use models\Session;
use models\User;
require_once "../models/Session.php";
require_once "../models/User.php";

if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
}
session_start();
$current_user = $_SESSION['user_id'];
$sessione = Session::Find($current_user);//cerco la sessione inbase all'id del utente
$sessione->Delete();
session_destroy();
//$_SESSION['current_user'] = null;
//session_unset();
header("Location: http://localhost:8000/views/login.php");
exit();