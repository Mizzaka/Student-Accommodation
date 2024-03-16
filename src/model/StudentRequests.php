<?php
    class StudentRequest {
        public $id;
        public $ad_id;
        public $std_name;
        public $std_contact;
        public $status;

        public function __construct(){}

        public function setId($id) {
            $this->id = $id;
        }
        public function setAdId($ad_id) {
            $this->ad_id = $ad_id;
        }
        public function setStdName($std_name) {
            $this->std_name = $std_name;
        }
        public function setStdContact($std_contact) {
            $this->std_contact = $std_contact;
        }
        public function setStatus($status) {
            $this->status = $status;
        }

        public function getId() {
            return $this->id;
        }
        public function getAdId() {
            return $this->ad_id;
        }
        public function getStdName() {
            return $this->std_name;
        }
        public function getStdContact() {
            return $this->std_contact;
        }
        public function getStatus() {
            return $this->status;
        }
    }
?>