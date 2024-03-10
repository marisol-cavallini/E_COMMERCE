<?php

use models\Product;

require_once "../DbManager.php";
require_once "../models/Product.php";

session_start();
/*if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
}*/
$products = Product::fetchAll();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girasole Store</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #6a1b9a;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #6a1b9a;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
            text-align: center;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin: 10px;
            width: 200px;
            text-align: center;
        }

        .quantity {
            padding: 5px;
            width: 60px;
        }

        input[type="submit"] {
            padding: 5px 10px;
            background-color: #6a1b9a;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
<header>
    <h1>Girasole Store</h1>
</header>
<nav>
    <a href="index.php">Prodotti</a>
    <a href="cart.php">Carrello</a>
    <?php
    if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == "admin" ) {
        ?>
        <a href="admin.php">Pannello Di Controllo</a>
        <?php
    }
    ?>
    <a href="../actions/logout.php">Logout</a>
</nav>
<div class="card-container">
    <h2>Catalogo prodotti</h2>
    <br>
    <?php
    require_once "..\models\Product.php";
    $products = Product::FindAll();
    $n = count($products);
    $i = 0;
    while ($i < $n) {
        ?>
        <div class="filler"></div>
        <div class="product-card">
        <div class="product-name"><?php echo "Nome: ". $products[$i]["nome"] ?></div>
        <div class="brand"><?php echo "Marca: " . $products[$i]["marca"] ?></div>
        <div class="price"><?php echo "Prezzo: " . $products[$i]["prezzo"] ?></div>
        <form action="../actions/cart.php" method="POST">
            <input class="quantity" type="number" name="quantita" placeholder="Qta">
            <input type="hidden" name="product_id" value="<?php echo $products[$i]["id"] ?>">
            <input class="buy-button" type="submit" name="submit" value="compra">
        </form>
        </div>
        <?php
        $i++;
    }
    ?>
</div>
</body>
</html>
