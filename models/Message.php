<?php

class Message{

    private $id;
    private $date;
    private $user_sent;
    private $user_destination;
    private $title;
    private $text;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getDate(){
        return $this->date;
    }

    function getUserSent(){
        return $this->user_sent;
    }

    function getUserDestination(){
        return $this->user_destination;
    }

    function getTitle(){
        return $this->title;
    }

    function getText(){
        return $this->text;
    }

    function setId($id){
        $this->id = $id;
    }

    function setDate($date){
        $this->date = $this->db->real_escape_string($date);
    }

    function setUserSent($user_sent){
        $this->user_sent = $user_sent;
    }

    function setUserDestination($user_destination){
        $this->user_destination = $user_destination;
    }

    function setTitle($title){
        $this->title = $this->db->real_escape_string($title);
    }

    function setText($text){
        $this->text = $this->db->real_escape_string($text);
    }

    public function save(){

        $sql = "INSERT INTO messages VALUES(null,
        '{$this->getDate()}','{$this->getUserSent()}',
        '{$this->getUserDestination()}','{$this->getTitle()}','{$this->getText()}')";

        $result = null;
        $save = $this->db->query($sql);
        if($save){
            $result = true;
        }else{
            $result = false;
        }

        return $result;
    }

    public function sentMessagesPerUser($id){
        $sql = "SELECT * FROM messages WHERE user_sent='{$id}'";
        
        $messages = $this->db->query($sql);
        if($messages){
            return $messages;
        }else{
            return null;
        }
    }

    public function receivedMessagePerUser($id){
        $sql = "SELECT * FROM messages WHERE user_destination='{$id}'";

        $messages = $this->db->query($sql);
        if($messages){
            return $messages;
        }else{
            return null;
        }
    }

    public function getMessageText($id){
        $sql = "SELECT text FROM messages WHERE id='{$id}'";
        $text = $this->db->query($sql);
        if($text){
            return $text;
        }else{
            return null;
        }

    }

    public function deleteMessage($id){
        $sql = "DELETE FROM messages WHERE id='{$id}'";
        $result = $this->db->query($sql);
        return $result;
    }

    







}