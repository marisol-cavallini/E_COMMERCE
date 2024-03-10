<?php
// Importazione delle classi necessarie
use models\User;
use models\Session;
require_once "..\DbManager.php";
require_once "..\models\User.php";
require_once "..\models\Session.php";

// Recupero delle informazioni dalla richiesta POST
$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);
// Controllo se esiste già un utente con la stessa email
$user = User::Find_User($email);
// Se esiste un utente con la stessa email, reindirizza alla pagina di registrazione
if($user){
    header('Location: http://localhost:8000/views/signup.php');
    exit;
}
$params = array("email" => $email, "password" => $password);// Creazione di un array con i parametri dell'utente
if (User::Find($params))//controllo se c'e gia un utente con quei parametri
{
    $queryString = http_build_query(array("creationSuccess" => false));//http_build_query trasforma questo array in una stringa di query URL,stringa avrà la forma di ?creationSuccess=false
    header('Location: http://localhost:8000/views/signup.php?'.$queryString);
    exit;
}
// Se tutto è a posto, crea un nuovo utente
$user = User::Create($params);
header('Location: http://localhost:8000/views/login.php');//reindirizzo a pagina di login