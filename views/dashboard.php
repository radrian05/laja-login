<?php
    include_once '../helpers/session_helper.php';

    //si no hay una sesió activa al acceder a esta página, se redirige a la página de login
    if(!isset($_SESSION['userId'])){
        flash("login", "Por favor, inicie sesión para continuar");
        header("location: login.php");
    }

    include_once 'header.php'
?>
    <h1 id="index-text">Bienvenido, <?php if(isset($_SESSION['userId'])){
        echo explode(" ", $_SESSION['userName'])[0];
    }else{
        echo 'Invitado';
    } 
    ?> </h1>
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
<?php
    include_once 'footer.php';
?>