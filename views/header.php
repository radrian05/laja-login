<?php 
    //session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login System</title>
    <?php 
    // obtiene el nombre de la pagina actual
    $currentPage = basename($_SERVER['PHP_SELF']);

    // Carga diferentes archivos CSS y JS según la página (se reemplazara en el futuro por vistas separadas con su propio header y footer)
    switch ($currentPage) {
        case 'dashboard.php':
            echo '<link rel="stylesheet" href="dashstyle.css" type="text/css">';
            break;
        default:
            echo '<link rel="stylesheet" href="style.css" type="text/css">';
            break;
    }
    ?>
</head>
<body>
    <nav>
        <ul>
            <a href="dashboard.php"><li>Home</li></a>
            <?php if(!isset($_SESSION['userId'])) : ?>
                <a href="signup.php"><li>Registro</li></a>
                <a href="login.php"><li>Iniciar Sesión</li></a>
            <?php else: ?>
                <a href="../controllers/Users.php?q=logout"><li>Cerrar Sesión</li></a>
            <?php endif; ?>
        </ul>
    </nav>