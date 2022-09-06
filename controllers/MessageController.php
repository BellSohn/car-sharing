<?php

require_once 'models/Message.php';
require_once 'models/Usuario.php';

class MessageController{

    public function index(){            
            
            $userId = $_SESSION['identity']->id;
            $message = new Message();
            $messageSet = $message->sentMessagesPerUser($userId);
            $receivedMessages = $message->receivedMessagePerUser($userId);
            if($messageSet){
                //var_dump($messageSet);die();   
                $numRows = $messageSet->num_rows;                
            }
            if($receivedMessages){
                $recNumRows = $receivedMessages->num_rows;
            }
            
        require_once 'views/message/index.php';
    }

    public function sentMessageDetail(){

        if($_POST){
            //var_dump($_POST);
            $messageId = isset($_POST['messageId']) ? $_POST['messageId'] : false;
            $userDestId = isset($_POST['userDestId']) ? $_POST['userDestId'] : false;
            $messageText = isset($_POST['messageTxt']) ? $_POST['messageTxt'] : false;

            if($messageId && $userDestId){
                 //get the message text
                 $message = new Message();
                  //$messageText = $message->getMessageText($messageId);
                  //var_dump($messageText->fetch_object());die();
                  //get data from User who sent the message
                    $userDestination = new Usuario();
                    $dataUser = $userDestination->getDataUser($userDestId);
                    //var_dump($dataUser->nick);die();
            }else{
                header('Location:'.base_url.'message/index');     
            }
           
        }else{
            header('Location:'.base_url.'message/index');
        }

        require_once 'views/message/sentdetail.php';
    }

    public function receivedMessageDetail(){

        if($_POST){
            //echo "vas a mostrar detalle mensaje recibido";
            //var_dump($_POST);
            $messageId = isset($_POST['messageId']) ? $_POST['messageId'] : null;
            $userSentId = isset($_POST['userSentId']) ? $_POST['userSentId'] : null;            
            
            if($messageId && $userSentId){

               //datos del usuario que envia el mensaje
                $userSent = new Usuario();
                $userSentData = $userSent->getDataUser($userSentId);

            //recibir texto del mensaje
                $receivedMessage = new Message();
                $receivedMessageText = $receivedMessage->getMessageText($messageId)->fetch_object();
                //var_dump($receivedMessageText);die();
               
                //die();

            }else{
                header("Location:".base_url."message/index");
            }



        }else{
            header("Location:".base_url."message/index");
        }

        require_once "views/message/receiveddetail.php";

    }

    public function deleteSentMessage(){
        if($_POST){
            //var_dump($_POST);die();
            $messageId = $_POST['messageId'];
            //var_dump($messageId);
            $messageToDelete = new Message();
            $result = $messageToDelete->deleteMessage($messageId);
            if($result){
                $_SESSION['deleteSentMessage']="complete";
            }else{
                $_SESSION['deleteSentMessage']="failed";
            }
        }else{
            $_SESSION['deleteSentMessage']="failed";
        }
        header("Location:".base_url."message/index");
    }


    public function deleteReceivedMessage(){

        if($_POST){
            //var_dump($_POST);
            $messageId = isset($_POST['messageId']) ? $_POST['messageId'] : null;
            //echo $messageId;
            $messageToDelete = new Message();
            $result = $messageToDelete->deleteMessage($messageId);
            if($result){
                $_SESSION['deleteMessage'] = 'complete';
                
            }else{
                $_SESSION['deleteMessage'] = 'failed';
                
            }
            
            
        }
        header("Location:".base_url."message/index");
    }

    public function insertAnswerMessage(){

        if($_POST){           
            
            $date = date("Y-m-d");      
            $user_sent = isset($_POST['logged_user_id']) ? $_POST['logged_user_id']:null ;
            $user_destination = isset($_POST['itinerary_user_id']) ? $_POST['itinerary_user_id']:null;
            $title = isset($_POST['msg-title'])? $_POST['msg-title']:null;
            $text = isset($_POST['msg-text']) ? $_POST['msg-text'] :null;
            
             if($date && $user_sent && $user_destination && $title && $text){

                $answerMessage = new Message();

                $answerMessage->setDate($date);
                $answerMessage->setUserSent($user_sent);
                $answerMessage->setUserDestination($user_destination);
                $answerMessage->setTitle($title);
                $answerMessage->setText($text);

                $result = $answerMessage->save();

                if($result){
                    $_SESSION['saveAnswerMessage'] = 'complete';
                }else{
                    $_SESSION['saveAnswerMessage'] = 'failed';
                }                

                
             }else{
                $_SESSION['saveAnswerMessage'] = 'failed';     
             }             

             

        }else{
            $_SESSION['saveAnswerMessage'] = 'failed';
        }
        header("Location:".base_url."message/receivedMessageDetail");
        //header("Location:".base_url."offer/index");
    }




}