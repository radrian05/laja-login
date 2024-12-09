<?php
require_once "../lib/db.php";

class User {
    private $db;
    
    public function __construct()
    {
        $this->db = new DB;
    }

    //Encontrar usuario por su correo o nombre de usuario
    public function findUserByEmailOrUsername($email, $username){
        $this->db->query('SELECT * FROM users WHERE userUid = :username OR userEmail = :email');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);

        //ejecuta el query
        $row = $this->db->single();

        //revisar fila
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    
    }

    //Registro del usuario enla base de datos
    public function register($data){
        $this->db->query('INSERT INTO users (userName, userEmail, userUid, userPwd) VALUES (:name, :email, :Uid, :password)');
        
        //bind
        $this->db->bind(':name', $data['userName']);
        $this->db->bind(':email', $data['userEmail']);
        $this->db->bind(':Uid', $data['userUid']);
        $this->db->bind(':password', $data['userPwd']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    //login
    public function login($nameOrEmail, $password){
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);

        if($row == false) return false; //si no existe, se termina la función

        $hashedPassword = $row->userPwd;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }
}
?>
