<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #7a4caf;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #7a4caf;
        }
    </style>
</head>
<body>

<form action="../actions/signup.php" method="POST">
    <h2>Sign Up</h2>

    <input type="text" name="email" placeholder="Enter your email">
    <br>
    <input type="password" name="password" placeholder="Enter your password">
    <br>
    <a href="login.php" class="signupLink">
        Sei registrato? Clicca qui.
    </a>
    <br><br>
    <input type="submit" value="Submit">

</form>
<?php
if (isset($_GET['creationSuccess']) && $_GET['creationSuccess'] == false) {
    ?>
    <div>
        <p class="loginFail">L'account esiste già</p>
    </div>
    <?php
}
?>
</body>
</html>
