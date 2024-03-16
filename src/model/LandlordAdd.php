<?php
 class LandlordAdd{
    public $id;
    public $bed;
    public $category;
    public $phone;
    public $price;
    public $description;
    public $location;
    public $status;
    public $landlord_id;

    public function __construct(){}

    public function setId($id){
        $this->id = $id;
    }
    public function setBed($bed){
        $this->bed = $bed;
    }
    public function setCategory($category){
        $this->category = $category;
    }
    public function setPhone($phone){
        $this->phone = $phone;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setLocation($location){
        $this->location = $location;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function setLandlordId($landlord_id){
        $this->landlord_id = $landlord_id;
    }

    public function getId(){
        return $this->id;
    }
    public function getBed(){
        return $this->bed;
    }
    public function getCategory(){
        return $this->category;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getLocation(){
        return $this->location;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getLandlordId(){
        return $this->landlord_id;
    }


 }
?>