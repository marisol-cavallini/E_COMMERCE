<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

    <form action="../actions/login.php" method="POST">
        <h1>Login</h1>
        <input type="text" name="email" placeholder="Enter your email">
        <br>
        <input type="password" name="password" placeholder="Enter your password">
        <br>
        <a href="signup.php" class="signupLink">
            Non sei registrato? Clicca qui.
        </a>
        <br><br>
        <input type="submit" value="Login" class="standardButton">

<?php
if (isset($_GET['loginSuccess']) && $_GET['loginSuccess'] == false) {
    ?>
    <div>
        <p class="loginFail">
            Le credenziali inserite sono errate
        </p>
    </div>
    <?php
}
?>
    </form>
</body>
</html>