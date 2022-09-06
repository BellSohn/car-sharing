<?php 


class Seek{

    private $id;
    private $departDate;
    private $startPlace;
    private $endPlace;
    private $seatsDemanded;
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

    function getStartPlace(){
        return $this->startPlace;
    }

    function getEndplace(){
        return $this->endPlace;
    }

    function getSeatsDemanded(){
        return $this->seatsDemanded;
    }

    function getUserId(){
        return $this->iduser;
    }

    function setSeekId($id){
        $this->id = $this->db->real_escape_string($id);
    }

    function setDepartDate($departDate){
        $this->departDate = $this->db->real_escape_string($departDate);
    }

    function setStartPlace($startPlace){
        $this->startPlace = $this->db->real_escape_string($startPlace);
    }

    function setEndPlace($endPlace){
        $this->endPlace = $this->db->real_escape_string($endPlace);
    }

    function setSeatsDemanded($seatsDemanded){
        $this->seatsDemanded = $this->db->real_escape_string($seatsDemanded);
    }

    function setUserId($iduser){
        $this->iduser = $this->db->real_escape_string($iduser);
    }

    public function allSeek(){
        $sql = "SELECT * FROM seek";
        $seekSet = $this->db->query($sql);
        if($seekSet){
            return $seekSet;
        }else{
            return false;
        }
    }


    public function saveSeek(){

        $sql = "INSERT INTO seek VALUES(null,'{$this->getDepartDate()}',
        '{$this->getStartPlace()}',
        '{$this->getEndplace()}','{$this->getSeatsDemanded()}','{$this->getUserId()}')";

        $result = false;
        $savedSeek = $this->db->query($sql);

        if($savedSeek){
            $result = true;
        }else{
            echo $sql;
        }

        return $result;
    }

    public function getSeekPerUser($id){
        $sql = "SELECT * FROM seek WHERE id_usuario='{$id}'";

        $seekSet = $this->db->query($sql);
        if($seekSet){
            return $seekSet;
        }else{
            return null;
        }

    }

    public function seekDetail($id){
        $sql = "SELECT * FROM seek WHERE id='{$id}'";

        $seekDetail = $this->db->query($sql);
        if($seekDetail){
            return $seekDetail->fetch_object();
        }else{
            echo $sql;
        }
    }

    public function updateSeek(){
        $sql = "UPDATE seek SET depart_date='{$this->getDepartDate()}'
        ,start_place='{$this->getStartPlace()}',
        end_place='{$this->getEndplace()}',
        seats_demanded='{$this->getSeatsDemanded()}'WHERE id='{$this->getId()}'";
       
        $update = $this->db->query($sql);
        $result = false;
        if($update){
            $result = true;
        }else{
            echo $sql;
        }
        return $result;

    }












}