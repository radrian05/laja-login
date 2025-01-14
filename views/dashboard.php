<?php
    include_once '../helpers/session_helper.php';
    ensureLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Login System</title>
        <link rel="stylesheet" href="dashstyle.css" type="text/css">
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

        <h1 id="index-text">Bienvenido, <?php echo explode(" ", $_SESSION['userName'])[0]; ?> </h1>
        <section id="product-list">
            <h2>Lista de Productos</h2>
            <button id="toggle-currency">Ver en Bolívares</button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>10101010101</td>
                        <td>Producto de Ejemplo</td>
                        <td>Ejemplo</td>
                        <td>Categoria1</td>
                        <td>0$</td>
                        <td>0</td>
                        <td>
                            <button>Editar</button>
                            <button>Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        
        <footer>
            <p>&copy; LAJA-DB <?php echo date("Y"); ?></p>
        </footer>
    </body>
</html>