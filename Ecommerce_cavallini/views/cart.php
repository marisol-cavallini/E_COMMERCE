<?php
session_start();
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            color: #6a1b9a;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .standardButton {
            padding: 8px 12px;
            background-color: #6a1b9a;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        form {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
    if ($_SESSION['ruolo'] == "admin") {
        ?>
        <a href="admin.php">Pannello Di Controllo</a>
        <?php
    }
    ?>
    <a href="../actions/logout.php">Logout</a>
</nav>

<table>
    <tbody>

    <table>
        <thead>
        <tr>
            <th>Articolo</th>
            <th>Prezzo</th>
            <th>Quantita</th>
        </tr>
        <tr>
            <?php
            use models\Product;
            use models\Cart_product;
            use models\Cart;
            require_once "..\models\Product.php";
            require_once "..\models\Cart.php";
            require_once "..\models\Cart_product.php";
            $cart = Cart::FindbyUser($_SESSION["user_id"]);// Recupera il carrello dell'utente corrente
            if($cart)
            {
                $params = array("cart_id" => $cart->GetId(), "user_id" => $_SESSION["user_id"]);
                $products = Cart_product::Test($params);
                $n = count($products);
                $i = 0;
                $temp_products = array("articolo", "prezzo");
                $i=0;
                while ($i < $n)// Itera attraverso i prodotti nel carrello
                {
                ?>
            <tr>
                <td>
                    <p><?php echo $products[$i]["marca"] . " - " . $products[$i]["nome"] ?></p>
                </td>
                <td>
                    <p><?php echo $products[$i]["prezzo"] * $products[$i]["quantita"] ?></p>
                </td>
                <td>
                    <p><?php echo $products[$i]["quantita"] ?></p>
                </td>
            </tr>

                <?php
                $i++;
                }
                $totalPrice = 0;
                $quantita = 0;
                foreach ($products as $product) {
                    $totalPrice = $product["prezzo"] * $product["quantita"] + $totalPrice;
                    $quantita = $product["quantita"] + $quantita;
                }
                ?>

                <tr>
            <form>
                <td>
                    <input type="submit" name="checkout" value="checkout" class="standardButton" readonly/>
                </td>
                <td>
                    <input type="number" name="totalPrice" value="<?php echo $totalPrice ?>" readonly/>
                </td>
                <td>
                    <input type="number" name="totalQuantity" value="<?php echo $quantita ?>" readonly/>
                </td>
            </form>
        </tr>
        <?php
            }

        ?>
        </thead>
    </tbody>
</table>
</body>

</html>