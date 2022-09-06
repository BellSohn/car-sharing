<?php 

require_once 'models/Itinerario.php';
require_once 'models/Message.php';
require_once 'models/Usuario.php';

class OfferController{

    public function index(){
        

        require_once 'views/offer/index.php';
    }

    public function AjaxUserNameCall(){
        if($_POST){
            $user_it_id = $_POST['iduser'];           
            $user = new Usuario();
            $userData = $user->getDataUser($user_it_id);            
           if($userData){
            //var_dump($userData->name);die();
            $name = $userData->name;
            $surname = $userData->surname;
            $nick = $userData->nick;
            
           }
            

            echo json_encode($name." ".$surname. " (".$nick.")");
            exit();
            //echo "contact".$user_it_id."user";
        }
        //header("Location:".base_url."offer/offerSearch");
    }

    public function insertMessage(){
        if($_POST){
            //var_dump($_POST);die();
            $date = date("Y-m-d");
            //var_dump($date);
            $user_sent = isset($_POST['logged_user_id']) ? $_POST['logged_user_id'] : null;
            $user_destination = isset($_POST['itinerary_user_id']) ? $_POST['itinerary_user_id'] : null;
            $title = isset($_POST['msg-title']) ? $_POST['msg-title'] : null;
            $text = isset($_POST['msg-text']) ? $_POST['msg-text'] : null;

            if($date && $user_sent && $user_destination && $title && $text){

                $message = new Message();

                $message->setDate($date);
                $message->setUserSent($user_sent);
                $message->setUserDestination($user_destination);
                $message->setTitle($title);
                $message->setText($text);

                $result = $message->save();

                if($result){
                    $_SESSION['saveMessage'] = 'complete';    
                }else{
                    $_SESSION['saveMessage'] = 'failed';
                }           


            }else{
                $_SESSION['saveMessage'] = 'failed';
            }
            
        }else{
            $_SESSION['saveMessage'] = 'failed';
        }

        header("Location:".base_url."offer/index");
    }

    public function offerSearch(){
        if($_POST){
            //var_dump($_POST);die();
           $destination_search = isset($_POST['dest-search']) ? $_POST['dest-search'] : false;
           $date_search = isset($_POST['date-search']) ? $_POST['date-search'] :false;
           $seats_serch = isset($_POST['seats-search']) ? $_POST['seats-search']: false;
           //var_dump("destination : ".$destination_search." date : ".$date_search."seats : ".$seats_serch);die();

           $itinerario = new Itinerario();   
          // $numRows = 0;        

            if($destination_search && $date_search && $seats_serch){

                $resultSet = $itinerario->totalSearch($destination_search,$date_search,$seats_serch);
                if($resultSet){
                    $numRows = $resultSet->num_rows;
                    //var_dump($resultSet);die();
                    
                }
            }else if($destination_search && $date_search){
                //var_dump($_SESSION['identity']->id);die();
                $resultSet = $itinerario->searchPerDestAndDate($destination_search,$date_search);
                //$user_it_id = $resultSet->fetch_object()->id_usuario;
                //var_dump($user_it_id);
                if($resultSet){
                    //var_dump($resultSet->fetch_object()->id_usuario);die();
                   // $user_it_id = $resultSet->fetch_object()->id_usuario;
                    //var_dump($user_it_id);die();
                    $numRows = $resultSet->num_rows;
                    /*foreach($resultSet as $set){
                        $user_id = $set['id_usuario'];                        
                    }*/
                }
            }elseif($destination_search){
                $resultSet = $itinerario->searchPerPlace($destination_search);
                if($resultSet){
                    $numRows = $resultSet->num_rows;
                }

            }            

            require_once 'views/offer/index.php'; 
        }        
        
    }

   



}