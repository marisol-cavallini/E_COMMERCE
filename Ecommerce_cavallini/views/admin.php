<?php
session_start();

if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
} elseif ($_SESSION['ruolo'] != "admin") {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE BEST GIRASOLE</title>
    <style>
body {
    font-family: Arial, sans-serif;
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
        }

        th, td {
    padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
    background-color: #f2f2f2;
        }

        .standardButton {
    padding: 5px 10px;
            background-color: #6a1b9a;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        th, td {
    background-color: #6a1b9a;
    color: #fff;
    }
    </style>
</head>
<body>
<nav>
    <a href="index.php">Prodotti</a>
    <a href="cart.php">Carrello</a>
    <a href="admin.php">Pannello di Controllo</a>
    <a href="../actions/logout.php">Logout</a>
</nav>
<table>
    <tbody>

    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Marca</th>
            <th>Prezzo</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <tr>
</body>
<?php

use models\Product;

require_once "..\models\Product.php";
$products = Product::FindAll();
$n = count($products);
$i = 0;
while ($i < $n)
{
    ?>
    <form action="../actions/admin.php" method="post">
        <td>
            <input type="text" name="id" value="<?php echo $products[$i]["id"] ?>" readonly/>
        </td>
        <td>
            <input type="text" name="nome" value="<?php echo $products[$i]["nome"] ?>"/>
        </td>
        <td>
            <input type="text" name="marca" value="<?php echo $products[$i]["marca"] ?>"/>
        </td>
        <td>
            <input type="text" name="prezzo" value="<?php echo $products[$i]["prezzo"] ?>"/>
        </td>
        <td>
            <input type="submit" name="submit" value="Update" class="standardButton"/>
        </td>
        <td>
            <input type="submit" name="submit" value="Delete" class="standardButton"/>
        </td>
    </form>
    </tr>

    <?php
    $i++;
}
?>
<tr>
    <form action="../actions/admin.php" method="post">
        <td>

        </td>
        <td>
            <input type="text" name="nome" value=""/>
        </td>
        <td>
            <input type="text" name="marca" value=""/>
        </td>
        <td>
            <input type="text" name="prezzo" value=""/>
        </td>
        <td>
            <input type="submit" name="submit" value="Create" class="standardButton"/>
        </td>
    </form>
</tr>
</table>
</tbody>
</table>

</body>
</html>
