<?php
// Importo le classi necessarie
use models\Session;
use models\User;
use models\Role;
require_once "../DbManager.php";
require_once "../models/Session.php";
require_once "../models/User.php";
require_once "../models/Role.php";
//controllo se la sessione è già attiva
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");//se non è cosi lo riendirizzo alla pagina di login
}
// prendo email e password dalla richiesta POST
$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);//crittografo la password
//salvo i dati in un array
$params = array("email" => $email, "password" => $password);
$user = User::Find($params);//vado a controllare che sia presente al database se no reindirizzo
if (!$user) {
    $queryString = http_build_query(array("loginSuccess" => false));
    header('Location: http://localhost:8000/views/login.php?'.$queryString);
    exit;
}

$role_id = $user->GetRole_id();//Ottiengo l'ID del ruolo dell'utente
$role = Role::Find($role_id);//e trova il ruolo corrispondente nel database
$nomeRuolo = $role->GetNome();
//inizio la sessione
session_start();
// Registro la sessione nel database
$params = array("ip" => $_SERVER["REMOTE_ADDR"], "user_id" => $user->GetId());
Session::Create($params);
// Imposto le variabili di sessione
$_SESSION['ruolo'] = $nomeRuolo;
$_SESSION['user_id'] = $user->GetId();
$_SESSION['logged'] = true;
var_dump($_SESSION);//stampa le informazioni di sessione
header('Location: http://localhost:8000/views/index.php');//reindirizza alla homepage
exit;
