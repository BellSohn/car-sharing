<?php

require_once 'models/Usuario.php';
require_once 'models/Itinerario.php';
require_once 'models/Seek.php';

class UserController{


    public function register(){


        require_once 'views/user/register.php';
    }

    public function profil(){

        require_once 'views/user/profil.php';
    }

    public function passwordUpdate(){

        require_once 'views/user/password.php';
    }

    public function content(){

        require_once 'views/user/content.php';
    }

    public function saveNewSearch(){
        if(isset($_POST)){
            //var_dump($_POST);
            $userId = isset($_POST['userId']) ? $_POST['userId'] : false;
            $depart_date = isset($_POST['depart_date']) ? $_POST['depart_date'] :false;
            $start_place = isset($_POST['start_place']) ? $_POST['start_place'] :false;
            $end_place = isset($_POST['end_place']) ? $_POST['end_place'] :false;
            $seats_demanded = isset($_POST['seats_demanded']) ? $_POST['seats_demanded'] : false;

            if($userId && $depart_date && $start_place && $end_place && $seats_demanded){
             
                    $mySeek = new Seek();

                    $mySeek->setDepartDate($depart_date);
                    $mySeek->setStartPlace($start_place);
                    $mySeek->setEndPlace($end_place);
                    $mySeek->setSeatsDemanded($seats_demanded);
                    $mySeek->setUserId($userId);

                    //var_dump($mySeek);die();
                    $result = $mySeek->saveSeek();

                    if($result){
                        $_SESSION['seekSave'] = 'complete';
                    }else{
                        $_SESSION['seekSave'] = 'failed';
                    }
                    
            }else{
                $_SESSION['seekSave'] = 'failed';
            }
            
        }else{
            $_SESSION['seekSave'] = 'failed';
        }
        header("Location:".base_url."user/content");
    }

    public function saveNewItinerary(){
        if(isset($_POST)){
            //var_dump($_POST);
            //die();
            $departDate = isset($_POST['depart-date']) ? $_POST['depart-date'] : false;
            $departTime = isset($_POST['depart-time']) ? $_POST['depart-time'] : false;
            $departplace = isset($_POST['depart-place']) ? $_POST['depart-place'] :false;
            $endPlace = isset($_POST['end-place']) ? $_POST['end-place'] : false;
            $freeSeats = isset($_POST['free-seats']) ? $_POST['free-seats'] :false;
            $userid = isset($_POST['userId']) ? $_POST['userId'] : false;

            if($departDate && $departTime && $departplace && $endPlace && $freeSeats && $userid){

                    $itinerario = new Itinerario();

                    $itinerario->setDepartDate($departDate);
                    $itinerario->setDepartTime($departTime);
                    $itinerario->setDepartPlace($departplace);
                    $itinerario->setEndPlace($endPlace);
                    $itinerario->setFreeSeats($freeSeats);
                    $itinerario->setIdUser($userid);

                    $itinerario->saveItinerary();

                    if($itinerario){
                        $_SESSION['itinerary'] = 'complete';
                    }else{
                        $_SESSION['itinerary'] = 'failed';
                    }


            }else{
                $_SESSION['itinerary'] = 'failed';
            }

            
        }else{
            $_SESSION['itinerary'] = 'failed';
        }
        header("Location:".base_url.'user/content');
    }

    /*
     public function getUserItineraries(){
        echo "cojones";
        var_dump($_POST['userid']);
        die();
    }*/

    

    public function updatePassword(){
        if($_POST){
            //echo "llegan datos";
            //die();
            $id = $_SESSION['identity']->id;
            $password = $_POST['password'] ? $_POST['password'] :false;
            $newPass = $_POST['newpass'] ? $_POST['newpass'] : false;
            $passConfirm = $_POST['confirmpass'] ? $_POST['confirmpass'] :false;
           // var_dump("id : ".$id."password : ".$password);
            //die();
            if($password && $newPass && $passConfirm){
                $usuario = new Usuario();
                $usuario->setPassword($passConfirm);

                $save = $usuario->updatePassword($id);
                if($save){
                    $_SESSION['updatePassword'] = 'updated';
                }else{
                    $_SESSION['updatePassword'] = 'failed';
                }
            }else{
                $_SESSION['updatePassword'] = 'failed';
            }
            
        }else{
            $_SESSION['updatePassword'] = 'failed';
        }
        header("Location:".base_url.'user/passwordUpdate');
    }

    public function updatePersoData(){

        if(isset($_POST)){
           // var_dump($_POST);
            //die();
            $id = $_POST['userId'] ? $_POST['userId'] :false;
            $name = $_POST['name'] ? $_POST['name'] : false;
            $surname = $_POST['surname'] ? $_POST['surname'] :false;
            $nick = $_POST['nick'] ? $_POST['nick'] : false;
            $phone = $_POST['phone'] ? $_POST['phone'] :false;
            $email = $_POST['email'] ? $_POST['email'] :false;

            if($id && $name && $surname && $nick && $phone && $email){

                $userUpdate = new Usuario();
                $updatedUser = new Usuario();

                $userUpdate->setId($id);
                $userUpdate->setName($name);
                $userUpdate->setSurname($surname);
                $userUpdate->setNick($nick);
                $userUpdate->setPhone($phone);
                $userUpdate->setEmail($email);

                $update = $userUpdate->updatePerso();

                if($update){
                    $_SESSION['updateperso'] = 'complete';
                    /*here,I call getDataUser, to get the updated data from the user and put it on the session*/
                    $updatedUser = $userUpdate->getDataUser($id);                   
                    $_SESSION['identity'] = $updatedUser;

                }else{
                    $_SESSION['updateperso'] = 'failed';
                }
            }else{
                $_SESSION['updateperso'] = 'failed';
            }   

        }else{
            $_SESSION['updateperso'] = 'failed';
        }

        header("Location:".base_url.'user/profil');

    }

    public function login(){
        if(isset($_POST)){
        //echo "seguimos con el login";
        $email =$_POST['email'] ? $_POST['email'] : false;
        $password = $_POST['password'] ? $_POST['password'] :false;
        //echo("email : ".$email. " --password : ".$password);
            
            if($email && $password){

                $usuario = new Usuario();
                
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $loguedUser = $usuario->login();
                //var_dump($loguedUser);
                if($loguedUser && is_object($loguedUser)){
                    $_SESSION['identity'] = $loguedUser;
                    if($loguedUser->role == 'admin'){
                        $_SESSION['admin'] = true;
                    }

                }else{
                    $_SESSION['error_login'] = 'failed identification';
                }

            }
        }
        header("Location:".base_url);
    }

    public function logout(){
        Utils::logout();
        header("Location:".base_url);
    }


    public function saveUser(){

        if(isset($_POST)){
            //var_dump($_POST);
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $surname = isset($_POST['surname']) ? $_POST['surname']:false;
            $nick = isset($_POST['nick']) ? $_POST['nick']:false;
            $phone = isset($_POST['phone']) ? $_POST['phone']:false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] :false;
            $role = isset($_POST['role']) ? $_POST['role'] : false;
            //$role = 'user';

            if($name && $surname && $nick && $phone && $email && $password && $role){
                
                $usuario = new Usuario();

                $usuario->setName($name);
                $usuario->setSurname($surname);
                $usuario->setNick($nick);
                $usuario->setPhone($phone);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setRole($role);

                $save = $usuario->save();

                if($save){
                    $_SESSION['register'] = 'complete';
                }else{
                    $_SESSION['register'] = 'failed';
                }
            }else{
                $_SESSION['register'] = 'failed';
            }
            
        }else{
            $_SESSION['register'] = 'failed';
        }

        header("Location:" . base_url . 'user/register');

        
    }
}