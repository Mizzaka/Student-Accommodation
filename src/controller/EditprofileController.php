<?php

    session_start();
    require_once('../model/dbutil.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        if($_SESSION['user_type'] == 'student'){
            $isSuccess = DbUtil::editStudentProfile($id, $name, $email, $contact);
            if($isSuccess){
                header('Location: ../view/profile.php');
            }else{
                echo "<script>alert('Could not update profile. Try again')</script>";
                echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
            }            
        }else{
            $isSuccess = DbUtil::editLandlordProfile($id, $name, $email, $contact);
            if($isSuccess){
                header('Location: ../view/profile.php');
            }else{
                echo "<script>alert('Could not update profile. Try again')</script>";
                echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
            }
        }
    }

?>