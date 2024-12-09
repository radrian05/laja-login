<?php 
    include_once '../views/header.php';
    include_once '../helpers/session_helper.php';
?>

    <h1 class="header">Registro de Usuario</h1>

    <?php flash('register') ?>

    <form method="post" action="../controllers/Users.php">
        <input type="hidden" name="type" value="register">
        <input type="text" name="userName" 
        placeholder="Nombre y Apellido...">
        <input type="text" name="userEmail" 
        placeholder="Email...">
        <input type="text" name="userUid" 
        placeholder="Nombre de Usuario...">
        <input type="password" name="userPwd" 
        placeholder="Contraseña...">
        <input type="password" name="pwdRepeat" 
        placeholder="Repetir Contraseña">
        <button type="submit" name="submit">Listo</button>
    </form>
    
<?php 
    include_once '../views/footer.php';
?>