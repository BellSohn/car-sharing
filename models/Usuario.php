<?php



class Usuario{

private $id;
private $name;
private $surname;
private $nick;
private $phone;
private $email;
private $password;
private $role;
private $image;
private $db;

public function __construct(){
    $this->db = Database::connect();
}

function getId(){
    return $this->id;
}

function getName(){
    return $this->name;
}

function getSurname(){
    return $this->surname;
}

function getNick(){
    return $this->nick;
}

function getPhone(){
    return $this->phone;
}

function getEmail(){
    return $this->email;
}

function getPassword(){
    return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['coost'=>4]);
}

function getRole(){
    return $this->role;
}

function getImage(){
    return $this->image;
}

function setId($id){
$this->id = $id;
}

function setName($name){
    $this->name = $this->db->real_escape_string($name);
}

function setSurname($surname){
    $this->surname = $this->db->real_escape_string($surname);
}

function setNick($nick){
    $this->nick = $this->db->real_escape_string($nick);
}

function setPhone($phone){
    $this->phone = $this->db->real_escape_string($phone);
}

function setEmail($email){
    $this->email = $this->db->real_escape_string($email);
}

function setPassword($password){
    $this->password = $password;
}

function setRole($role){
    $this->role = $this->db->real_escape_string($role);
}

public function save(){

    $sql = "INSERT INTO usuarios VALUES(null,'{$this->getName()}',
    '{$this->getSurname()}','{$this->getNick()}','{$this->getPhone()}',
    '{$this->getEmail()}','{$this->getPassword()}','{$this->getRole()}','null')";

    $save = $this->db->query($sql);
    $result = false;

    if($save){
        $result = true;
    }else{
        echo $sql;
    }

    return $result;
}

public function updatePassword($id){
    $sql = "UPDATE usuarios SET password='{$this->getPassword()}'WHERE id='{$id}'";

    $update = $this->db->query($sql);
    $result = false;
    if($update){
        $result = true;
    }else{
        echo $sql;
    }
    return $result;
}

public function updatePerso(){

    $sql = "UPDATE usuarios SET name='{$this->getName()}',surname='{$this->getSurname()}',
    nick='{$this->getNick()}',phone='{$this->getPhone()}',email='{$this->getEmail()}' WHERE id='{$this->getId()}'";

    $update = $this->db->query($sql);
    $result = false;

    if($update){
        $result = true;
        
        //$result = $update;
    }else{
        echo $sql;
    }

    return $result;

}

public function getDataUser($id){
    $sql = "SELECT `id`,`name`,`surname`,`nick`,`phone`,`email` FROM `usuarios` WHERE id='{$id}'";
    $user = $this->db->query($sql);
    if($user && $user->num_rows == 1){
        $usuario = $user->fetch_object();
        return $usuario;
    }else{
        echo $sql;
    }
}

public function login(){
    $result = false;
    
    $email = $this->email;
    $password = $this->password;

    $sql = "SELECT * FROM usuarios WHERE email ='$email'";
    //$sql = "SELECT  'name','surname' FROM usuarios WHERE email = '$email'";
    $login = $this->db->query($sql);
    if($login && $login->num_rows == 1){
        $usuario = $login->fetch_object();
        //verify the password
        $verify = password_verify($password,$usuario->password);
        if($verify){
            $result = $usuario;
        }
    }
    return $result;
}


}//end clase