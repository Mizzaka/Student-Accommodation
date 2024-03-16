<?php
    require_once '../model/DbUtil.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = $_POST['title'];
        $description = $_POST['description'];

        $target_dir = "../../assets/blogimages/";
        $uploadOk = 1;

        $fileUploadSuccess = false;

        //inserting images
        $target_file = $target_dir . basename($_FILES["blogimage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["blogimage"]["tmp_name"]);

        // Check if image file is a actual image or fake image
        if($check) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('Sorry, file already exists.')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/addblogpost.php'}, 500);</script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["blogimage"]["size"] > 2000000) {
            echo "<script>alert('Sorry, your file is too large.')</script>";  //2000KB
            echo "<script>window.setTimeout(function(){window.location.href='../view/addblogpost.php'}, 500);</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed.')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/addblogpost.php'}, 500);</script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/addblogpost.php'}, 500);</script>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["blogimage"]["tmp_name"], $target_file)) {
                $fileName = htmlspecialchars(basename($_FILES["blogimage"]["name"]));
                // echo "The file ". $fileName . " has been uploaded. <br>";
                $fileUploadSuccess = true;

                if($fileUploadSuccess){
                    $blogSuccess = DbUtil::addBlog($title, $description, $fileName);
                    if($blogSuccess){
                        echo "<script>alert('Blog added successfully')</script>";
                        echo "<script>window.setTimeout(function(){window.location.href='../view/index.php'}, 500);</script>";
                    }
                }else{
                    $fileUploadSuccess = false;
                }
            } else {
                echo "<script>alert('Sorry, there was an error adding your blog .')</script>";
                echo "<script>window.setTimeout(function(){window.location.href='../view/addblogpost.php'}, 500);</script>";
            }
        }

        // if(!$fileUploadSuccess){
        //     $deleteSuccess = DbUtil::deletePost($foreignId);
        //     if($deleteSuccess){
        //         echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        //         echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
        //     }
        // }else{
        //     echo "<script>alert('Ad uploaded successfully')</script>";
        //     echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
        //     // header('Location: ../view/profile.php');
        // }
        

    }
?>