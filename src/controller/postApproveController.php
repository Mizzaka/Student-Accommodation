<?php
    session_start();
    require_once '../model/DbUtil.php';

    /* if(isset($_GET['id']) && isset($_GET['status'])){
         $id = $_GET['id'];
         $status = $_GET['status'];

         //else statment wont work if used truthy in php - if($status)
        if($status == 'true'){
             $isSuccess = DbUtil::wardenApproval($id, 'approved');
             if($isSuccess){
                 header('Location: ../view/index.php');
             }else{
                 echo "<script>alert('Sorry, could not update the status.')</script>";
                 echo "<script>window.setTimeout(function(){window.location.href='../view/index.php'}, 500);</script>";
             }
         }elseif($status == 'false'){
             $isSuccess = DbUtil::wardenApproval($id, 'rejected');
             if($isSuccess){
                 header('Location: ../view/index.php');
             }else{
                 echo "<script>alert('Sorry, could not update the status.')</script>";
                 echo "<script>window.setTimeout(function(){window.location.href='../view/index.php'}, 500);</script>";
             }
         }
     }*/

    if(isset($_POST['approve']) && isset($_POST['id'])){
        $cardId = $_POST['id'];
        $description = $_POST['description'];
        $isSuccess = DbUtil::wardenApproval($cardId, 'approved', $description);
        if($isSuccess){
            echo "<script>alert('Post approved successfully.')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/index.php'}, 500);</script>";
            // header('Location: ../view/index.php');
        }else{
            echo "<script>alert('Sorry, could not update the status.')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/index.php'}, 500);</script>";
        }
    }elseif(isset($_POST['reject']) && isset($_POST['id'])){
        $cardId = $_POST['id'];
        $description = $_POST['description'];
        $isSuccess = DbUtil::wardenApproval($cardId, 'rejected', $description);
        if($isSuccess){
            echo "<script>alert('Post rejected successfully.')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/index.php'}, 500);</script>";
        }else{
            echo "<script>alert('Sorry, could not update the status.')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/index.php'}, 500);</script>";
        }
    }
    
?>