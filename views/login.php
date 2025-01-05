<?php
    include_once '../views/header.php';
    include_once '../helpers/session_helper.php';

    if(isset($_SESSION['userId'])){
        header("location: ../views/dashboard.php");
    }
?>
    <?php flash('login') ?>

    <div class="login">
        <div class="logo">
            <img src="logo.jpeg" alt="Logo">
        </div>
        <h1>Inventario</h1>
        <form method="post" action="../controllers/Users.php">
        <input type="hidden" name="type" value="login">
            <label for="name">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="name" placeholder="Nombre de Usuario...">

            <label for="userPwd">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="userPwd" placeholder="Contraseña...">
            <button type="submit" name="submit">Iniciar Sesión</button>
        </form>
    </div>

    
    
<?php 
    include_once '../views/footer.php'
?>