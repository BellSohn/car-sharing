<?php

class Itinerario{

    private $id;
    private $departDate;
    private $departTime;
    private $departPlace;
    private $endPlace;
    private $freeSeats;
    private $iduser;
    private $db;

    
    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;        
    }

    function getDepartDate(){
        return $this->departDate;
    }

    function getDepartTime(){
        return $this->departTime;
    }

    function getDepartPlace(){
        return $this->departPlace;
    }

    function getEndPlace(){
        return $this->endPlace;
    }

    function getFreeSeats(){
        return $this->freeSeats;
    }

    function getUserId(){
        return $this->iduser;
    }

    function setId($id){
        $this->id= $id;
    }

    function setDepartDate($departDate){
        $this->departDate = $this->db->real_escape_string($departDate);
    }

    function setDepartTime($departTime){
        $this->departTime = $this->db->real_escape_string($departTime);
    }

    function setDepartPlace($departPlace){
        $this->departPlace = $this->db->real_escape_string($departPlace);
    }

    function setEndPlace($endPlace){
        $this->endPlace = $this->db->real_escape_string($endPlace);
    }

    function setFreeSeats($freeSeats){
        $this->freeSeats = $this->db->real_escape_string($freeSeats);
    }

    function setIdUser($iduser){
        $this->iduser = $this->db->real_escape_string($iduser);
    }

    public function saveItinerary(){

        $sql = "INSERT INTO itinerary VALUES(null,'{$this->getDepartDate()}',
        '{$this->getDepartTime()}','{$this->getDepartplace()}',
        '{$this->getEndPlace()}','{$this->getFreeSeats()}','{$this->getUserId()}')";

          $result = false;
          $save = $this->db->query($sql);

          if($save){
              $result = true;
          }else{
              $result = false;
          }

          return $result;

    }

    public function getUserItineraries($id){
        $sql = "SELECT * FROM itinerary WHERE id_usuario ='{$id}'";
        $itinerariSet = $this->db->query($sql);
        if($itinerariSet){
            return $itinerariSet;
        }else{
            return null;
        }
    }

    public function searchPerPlace($place){
        $sql = "SELECT * FROM itinerary 
        WHERE end_place LIKE '%{$place}%'";
        $resultSet = $this->db->query($sql);

        if($resultSet){
            return $resultSet;
        }else{
            return null;    
        }
    }

    public function totalSearch($destination,$date,$seats){
        $sql = "SELECT * FROM itinerary
         WHERE depart_date='{$date}' AND end_place LIKE '%{$destination}%' AND free_seats='{$seats}'";

        $resultSet = $this->db->query($sql);
        if($resultSet){
            return $resultSet;
        }else{
            return null;
        }
    }

    public function searchPerDestAndDate($destination,$date){
        $sql = "SELECT * FROM itinerary WHERE end_place LIKE '%{$destination}%' AND depart_date='{$date}'";

        $resultSet = $this->db->query($sql);
        if($resultSet){
            return $resultSet;
        }else{
            return null;
        } 
    }



    public function getDetailsItinerary($id){
        $sql = "SELECT * FROM itinerary WHERE id='{$id}'";
        $detail = $this->db->query($sql);
        if($detail){
            return $detail->fetch_object();
        }else{
            return null;
        }
    }

    public function updateItinerary(){
        $sql = "UPDATE itinerary SET depart_date='{$this->getDepartDate()}',
        depart_time='{$this->getDepartTime()}',
        depart_place='{$this->getDepartPlace()}',
        end_place='{$this->getEndPlace()}',free_seats='{$this->getFreeSeats()}' WHERE id='{$this->getId()}'";        
        
        $update = $this->db->query($sql);
        $result = false;

        if($update){
            $result = true;
        }else{
            //$result = false;
            echo $sql;
        }

        return $result;



    }

}