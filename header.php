<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login System</title>
    <link rel="stylesheet" href="./style.css" type="text/css">
</head>
<body>
    <nav>
        <ul>
            <a href="index.php"><li>Home</li></a>
            <?php if(!isset($_SESSION['userId'])) : ?>
                <a href="signup.php"><li>Registro</li></a>
                <a href="login.php"><li>Iniciar Sesión</li></a>
            <?php else: ?>
                <a href="./controllers/Users.php?q=logout"><li>Cerrar Sesión</li></a>
            <?php endif; ?>
        </ul>
    </nav>