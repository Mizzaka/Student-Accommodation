<?php
    session_start();
    require_once '../model/DbUtil.php';

    if(isset($_GET['id']) && isset($_GET['status'])){
        $id = $_GET['id'];
        $status = $_GET['status'];

        if($status == 'true'){
            $isSuccess = DbUtil::updateStdRequest($id, 'approved');
            if($isSuccess){
                header('Location: ../view/profile.php');
            }else{
                echo "<script>alert('Sorry, could not update the status.')</script>";
                echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
            }
        }elseif($status == 'false'){
            $isSuccess = DbUtil::updateStdRequest($id, 'rejected');
            if($isSuccess){
                header('Location: ../view/profile.php');
            }else{
                echo "<script>alert('Sorry, could not update the status.')</script>";
                echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
            }
        }
    }
?>