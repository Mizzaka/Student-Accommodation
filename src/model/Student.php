<?php
class Student {
    public $id;
    public $name;
    public $email;
    public $contact;


    public function __construct(){}

    
    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setContact($contact){
        $this->contact = $contact;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getContact(){
        return $this->contact;
    }
}




?>