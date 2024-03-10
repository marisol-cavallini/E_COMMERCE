<?php
use models\Session;
use models\User;
use models\Role;
use models\Product;

require_once "../DbManager.php";
require_once "../models/User.php";
require_once "../models/Session.php";
require_once "../models/Role.php";
require_once "../models/Product.php";
session_start();//crea una sezione o riprende quella corrente
if (!isset($_SESSION['logged'])) {//se no è logata la mandiamo a logarsi
    header("Location: login.php");
} elseif ($_SESSION['ruolo'] != "admin") {//controllo il ruolo del utente
    header("Location: index.php");
}
//salvo i dati che ho scritto nelle textbox
$product = new Product();
$product->SetId($_POST['id']);
$product->SetMarca($_POST['marca']);
$product->SetNome($_POST['nome']);
$product->SetPrezzo($_POST['prezzo']);
$choice = $_POST["submit"];
if ($choice == "Update") {
    $product->Update();
    header('Location: http://localhost:8000/views/admin.php');
    exit;
} else if ($choice == "Delete") {
    $product->Delete();
    header('Location: http://localhost:8000/views/admin.php');
    exit;
} else if ($choice == "Create") {
    $params = array("id" => $product->GetId(), "nome" => $product->GetNome(), "marca" => $product->GetMarca(), "prezzo" => $product->GetPrezzo());
    Product::Create($params);
    header('Location: http://localhost:8000/views/admin.php');
    exit;
}