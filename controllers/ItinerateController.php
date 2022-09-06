<?php

require_once 'models/Itinerario.php';
require_once 'models/Seek.php';

class ItinerateController{


    public function index(){

        $itinerario = new Itinerario();
        $seek = new Seek();

        $userId = $_SESSION['identity']->id;
        //echo "userId : ".$userId;
        $myitineraries = $itinerario->getUserItineraries($userId);
        //var_dump($myitineraries);die();
        $miSeeks = $seek->getSeekPerUser($userId);
        $seekRows = $miSeeks->num_rows;
        $numRows = $myitineraries->num_rows;
        //var_dump($myitineraries->num_rows);
        //die();


        //var_dump("estas en getUserItineraries");
       require_once 'views/itinerate/index.php';

    }

    public function detail(){
        
        
        if(isset($_GET['id'])){
        
            $itineraryId = $_GET['id'];        
            $itineraryDetail = new Itinerario();
            $details = $itineraryDetail->getDetailsItinerary($itineraryId);
            

        }

        require_once 'views/itinerate/detail.php';
    }

    public function updateItinerate(){
        if($_POST){
            //var_dump($_POST);
           $itId = isset($_POST['itid']) ? $_POST['itid'] : false;
           $departDate = isset($_POST['depart_date']) ? $_POST['depart_date'] : false;
           $departTime = isset($_POST['depart_time']) ? $_POST['depart_time'] : false;
           $departPlace = isset($_POST['depart_place']) ? $_POST['depart_place'] :false;
           $endPlace = isset($_POST['end_place']) ? $_POST['end_place'] :false;
           $freeSeats = isset($_POST['free_seats']) ? $_POST['free_seats'] : false;

           if($itId && $departDate && $departTime && $departPlace && $endPlace && $freeSeats){
//var_dump("id : ". $itId."dep date :".$departDate."dep time ".$departTime."dep plc :".$departPlace."end plc : ".$endPlace."fse :".$freeSeats);die();
            //create the object
            $itinerate = new Itinerario();
            
            $itinerate->setDepartDate($departDate);
            $itinerate->setDepartTime($departTime);
            $itinerate->setDepartPlace($departPlace);
            $itinerate->setEndPlace($endPlace);
            $itinerate->setFreeSeats($freeSeats);
            $itinerate->setId($itId);
            //var_dump($itinerate);die();
            $update = $itinerate->updateItinerary();

            if($update){
                $_SESSION['updateItinerate'] = 'complete';
            }else{
                $_SESSION['updateItinerate'] = 'failed';
            }


           }else{
               $_SESSION['updateItinerate'] = 'failed';
           }


        }else{
            $_SESSION['updateItinerate'] = 'failed';
        }
        header("Location:".base_url.'itinerate/detail&id='.$itId);
    }







}