<?php

use models\Cart;
use models\Session;
use models\User;
use models\Role;
use models\Product;
use models\Cart_product;

require_once "../DbManager.php";
require_once "../models/User.php";
require_once "../models/Session.php";
require_once "../models/Role.php";
require_once "../models/Product.php";
require_once "../models/Cart.php";
require_once "../models/Cart_product.php";

session_start();
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
}
$user_id = $_SESSION["user_id"];//prendo id del utente
$cart = Cart::FindbyUser($user_id);//cerco utente
if (!$cart) {//se non c'e il carrello
    $cart = Cart::Create($user_id);//creazione carrello
    //parametri per creazione del prodotto
    $params = array("quantita" => (int)$_POST["quantita"], "product_id" => (int)$_POST["product_id"], "cart_id" => $cart->GetId());
    Cart_product::Create($params);
    header('Location: http://localhost:8000/views/index.php');
    exit;
}
else if ($cart)//se c'è ci inserisco i prodotti
{
    $params = array("product_id" => (int)$_POST["product_id"], "cart_id" => $cart->GetId());
    $cart_product = Cart_product::Find($params);
    if($cart_product)
    {
        $quantity = $cart_product->GetQuantita();
        $sum = $quantity + (int)$_POST["quantita"];
        $params = array("quantita" => $sum, "product_id" => (int)$_POST["product_id"], "cart_id" => $cart->GetId());
        $cart_product->Update($params);//sistemare qua
    }
    else
    {
        $params = array("quantita" => (int)$_POST["quantita"], "product_id" => (int)$_POST["product_id"], "cart_id" => $cart->GetId());
        $cart_product = Cart_product::Find($params);
        Cart_product::Create($params);
    }
    header('Location: http://localhost:8000/views/index.php');
    exit;
}
