<?php
    session_start();
    require_once '../model/DbUtil.php';

    if(isset($_GET['id']) && isset($_GET['std']) && isset($_GET['landlord'])){
        $ad_id = $_GET['id'];
        $std_id = $_GET['std'];
        $landlord_id = $_GET['landlord'];

        $stdDetails = DbUtil::getStudentDetails($std_id);
        $std_name = $stdDetails->name;
        $std_contact = $stdDetails->contact;

        if(!(empty($std_name) && empty($std_contact))){
            $isSuccess = DbUtil::addStudentRequest($ad_id, $std_id, $landlord_id, $std_name, $std_contact);

            if($isSuccess){
                echo "<script>alert('Request added successfully')</script>";
                echo "<script>window.setTimeout(function(){window.location.href='../view/testcard.php'}, 500);</script>";
            }else{
                echo "<script>alert('Sorry, could not add your request.')</script>";
                echo "<script>window.setTimeout(function(){window.location.href='../view/testcard.php'}, 500);</script>";
            }
        }

    }
?>