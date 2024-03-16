<?php

require_once('../model/dbutil.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $type = $_POST['acctype'];
    $password = $_POST['password'];
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_NUMBER_INT);

    if($_POST['password'] == $_POST['conpassword']){
        $result = DbUtil::registerUser($name, $email, $contact, $password, $type);
        if($result){
            header("Location: ../view/login.php");
        }      
    }else {
        echo "<script>alert('Passwords do not match')</script>";
        echo "<script>window.setTimeout(function(){window.location.href='../view/register.php'}, 500);</script>";
    }


}

?>