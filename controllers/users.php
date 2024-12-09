<?php
require_once "../models/User.php";
require_once "../helpers/session_helper.php";

class Users{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User; 
    }

    public function register(){
        //procesa el formulario

        // Sanitizar POST data (sin usar FILTER_SANITIZE_STRING)
        $_POST['userName'] = htmlspecialchars(trim($_POST['userName']));
        $_POST['userEmail'] = htmlspecialchars(trim($_POST['userEmail']));
        $_POST['userUid'] = htmlspecialchars(trim($_POST['userUid']));
        $_POST['userPwd'] = htmlspecialchars(trim($_POST['userPwd']));
        $_POST['pwdRepeat'] = htmlspecialchars(trim($_POST['pwdRepeat']));

        //init data
        $data = [
            'userName' => $_POST['userName'],
            'userEmail' => $_POST['userEmail'],
            'userUid' => $_POST['userUid'],
            'userPwd' => $_POST['userPwd'],
            'pwdRepeat' => $_POST['pwdRepeat']
        ];

        //validar data
        if(empty($data['userName']) || empty($data['userEmail']) || empty($data['userUid']) || empty($data['userPwd']) || empty($data['pwdRepeat'])){
            //algo de un error
            flash("register", "Por favor llene todos los campos");
            redirect("../signup.php");
        }

        //si el nombre de usuario tiene caracteres no alfanumericos
        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['userUid'])){
            flash("register", "Nombre de usuario invalido");
            redirect("../signup.php");
        }

        if(!filter_var($data['userEmail'], FILTER_VALIDATE_EMAIL)){
            flash("register", "email invalido");
            redirect("../signup.php");
        }

        //si la contraseña tiene menos de 8 caracteres
        if(strlen($data['userPwd']) < 8){
            flash("register", "Invalid password");
            redirect("../signup.php");
        } else if($data['userPwd'] !== $data['pwdRepeat']){ //si las contraseñas no coinciden
            flash("register", "Las contraseñas no coinciden");
            redirect("../signup.php");
        }

        //Si existe un usuario con el mismo email o username
        if($this->userModel->findUserByEmailOrUsername($data['userEmail'], $data['userName'])){
            flash("register", "El Nombre de usuario o correo ya está en uso");
            redirect("../signup.php");
        }

        //si se llega a este punto, se ha pasado todas las validaciones
        //ahora se "hasheará" la contraseña

        $data['userPwd'] = password_hash($data['userPwd'], PASSWORD_DEFAULT);

        //Registrar Usuario
        if($this->userModel->register($data)){
            redirect("../login.php");
        }else{
            die("Algo salio mal...");
        }
    }

    public function login(){
        //sanitizar POST data (sin FILTER_SANITIZE_STRING)
        $_POST['userPwd'] = htmlspecialchars(trim($_POST['userPwd']));
        $_POST['name/email'] = htmlspecialchars(trim($_POST['name/email']));

        //init
        $data=[
            'name/email' => $_POST['name/email'],
            'userPwd' => $_POST['userPwd'],
        ];

        if(empty($data['name/email']) || empty($data['userPwd'])){
            flash("login", "Por favor, complete todos los campos");
            header("location: ../login.php");
            exit();
        }   
        
        //revisa si el usuario o email existe
        if($this->userModel->findUserByEmailOrUsername($data['name/email'], $data['name/email'])){
            //si el usuario o correo fue encontrado
            $loggedInUser = $this->userModel->login($data['name/email'], $data['userPwd']);
            if($loggedInUser){
                //crear sesión
                $this->createUserSession($loggedInUser);
            }
        }else{ 
            //si el usuario no fue encontrado
            flash("login", "Usuario no encontrado");
            redirect("../login.php");
        }
   }

   //crea la sesión
   public function createUserSession($user){
    $_SESSION['userId'] = $user->userId;
    $_SESSION['userName'] = $user->userName;
    $_SESSION['userEmail'] = $user->userEmail;
    redirect("../index.php");
   }

   //cierra la sesión
   public function logout(){
    unset($_SESSION['userId']);
    unset($_SESSION['userName']);
    unset($_SESSION['userEmail']);
    session_destroy();
    redirect("../index.php");
   }
}
    




$init = new Users;

if($_SERVER['REQUEST_METHOD'] == 'POST'){ //maneja el tipo de formulario para registrar usuario o iniciar sesión
    switch($_POST['type']){
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
    }
}else{
    switch($_GET['q']){ //maneja el query para cerrar la sesión
        case 'logout':
            $init->logout();
            break;
        default:
        redirect("../index.php");
    }
}

?>