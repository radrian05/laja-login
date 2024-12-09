<?php 
    include_once 'header.php';
    include_once './helpers/session_helper.php';
?>
    <h1 class="header">Inicio de Sesión</h1>

    <?php flash('login') ?>

    <form method="post" action="./controllers/Users.php">
    <input type="hidden" name="type" value="login">
        <input type="text" name="name/email"  
        placeholder="Nombre de Usuario/Email...">
        <input type="password" name="userPwd" 
        placeholder="Contraseña...">
        <button type="submit" name="submit">Iniciar Sesión</button>
    </form>

    
    
<?php 
    include_once 'footer.php'
?>