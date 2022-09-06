<?php

require_once 'models/Seek.php';

class SeekController{

    public function index(){

        
        $seekObject = new Seek();
        $allAvailableSeek = $seekObject->allSeek();
        $numRows = $allAvailableSeek->num_rows;
        //echo $allAvailableSeek->num_rows;
       //die();
        



        require_once "views/seek/index.php";
    }



public function detail(){

    if(isset($_GET['id'])){
        $seekId = $_GET['id'];
        //echo "seek id es : ".$seekId;
        //die();
        $detail = new Seek();
        $mySeekDetail = $detail->seekDetail($seekId);
        //var_dump($mySeekDetail);die();
        
    }

    require_once 'views/seek/detail.php';

}

public function updateSeek(){

    if(isset($_POST)){
        //var_dump($_POST);
        $seekId = isset($_POST['seekId']) ? $_POST['seekId'] :false;
        $departDate = isset($_POST['depart_date']) ? $_POST['depart_date'] : false;
        $startPlace = isset($_POST['start_place']) ? $_POST['start_place'] : false;
        $endPlace = isset($_POST['end_place']) ? $_POST['end_place'] : false;
        $seatsDemanded = isset($_POST['seats_demanded']) ? $_POST['seats_demanded'] :false;

        if($seekId && $departDate && $startPlace && $endPlace && $seatsDemanded){

                    $seekObj = new Seek();
                
                    $seekObj->setSeekId($seekId);
                    $seekObj->setDepartDate($departDate);
                    $seekObj->setStartPlace($startPlace);
                    $seekObj->setEndPlace($endPlace);
                    $seekObj->setSeatsDemanded($seatsDemanded);

                    $uptResult = $seekObj->updateSeek();

                    if($uptResult){
                        $_SESSION['seekUpdate'] = 'complete';
                    }else{
                        $_SESSION['seekUpdate'] = 'failed';
                    }


        }else{
            $_SESSION['seekUpdate'] = 'failed';    
        }



    }else{
        $_SESSION['seekUpdate'] = 'failed';
    }
    header("Location:".base_url.'seek/detail&id='.$seekId);

}


}