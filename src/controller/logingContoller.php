<?php

require_once('../model/dbutil.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password = $_POST['password'];
    $type = $_POST['acctype'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if($type == 'student'){
        $student = DbUtil::getStudent($email, $password);

        if($student){
            session_start();
            // $student = new Student();
            $_SESSION['user'] = $student->getEmail();
            $_SESSION['user_type'] = 'student';
            $_SESSION['user_id'] = $student->getId();
            header("Location: ../view/home.php");
        }else {
            echo "<script>alert('Incorrect email or password')</script>";
            // header("Location: ../view/login.php");
            echo "<script>window.setTimeout(function(){window.location.href='../view/login.php'}, 500);</script>";
        }
    }elseif($type == 'landlord'){
        $landlord = DbUtil::getLandlord($email, $password);

        if($landlord){
            session_start();
            $_SESSION['user'] = $landlord->getEmail();
            $_SESSION['user_type'] = 'landlord';
            $_SESSION['user_id'] = $landlord->getId();
            header("Location: ../view/Addpost.php");
        }else {
            echo "<script>alert('Incorrect email or password')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/login.php'}, 500);</script>";
        }
    }elseif($type == 'warden'){
        $result = DbUtil::getWarden($email, $password);

        if($result){
            session_start();
            $_SESSION['user'] = $email;
            $_SESSION['user_type'] = 'warden';
            $_SESSION['user_id'] = '101';
            header("Location: ../view/card2.php");
        }else {
            echo "<script>alert('Incorrect email or password')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/login.php'}, 500);</script>";
        }
    }else{
        /*$result = DbUtil::getAdmin($email, $password);

        if($result){
            session_start();
            $_SESSION['user'] = $email;
            $_SESSION['user_type'] = 'admin';
            $_SESSION['user_id'] = '1';
            header("Location: ../view/index.php");
        }else {
            echo "<script>alert('Incorrect email or password')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/login.php'}, 500);</script>";
        }*/
    }
}

?>