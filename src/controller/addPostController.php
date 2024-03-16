<?php

    require_once '../model/DbUtil.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $location = $_POST['location'];
        $beds = $_POST['beds'];
        $baths = $_POST['baths'];
        $category = $_POST['category'];
        $phone = $_POST['phone'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        $target_dir = "../../assets/images/";
        $uploadOk = 1;

        $totalFiles = count($_FILES['photos']['name']);
        $uploadedFiles = 0;
        $fileUploadSuccess = false;

        //inserting form details
        $foreignId = DbUtil::addPost($_SESSION['user_id'], $beds, $baths, $category, $phone, $price, $description, $location, $latitude, $longitude);

        //inserting images
        if($foreignId !== null){
            for($i = 0; $i < $totalFiles; $i++) {
                $target_file = $target_dir . basename($_FILES["photos"]["name"][$i]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["photos"]["tmp_name"][$i]);
    
                // Check if image file is a actual image or fake image
                if($check) {
                    // echo "File is an image - " . $check["mime"] . ".<br>";     //$check["mime"] = e.g. image/jpeg
                    $uploadOk = 1;
                } else {
                    // echo "<script>alert('File is not an image.')</script>";
                    $uploadOk = 0;
                }
    
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "<script>alert('Sorry, file already exists.')</script>";
                    echo "<script>window.setTimeout(function(){window.location.href='../view/addpost.php'}, 500);</script>";
                    $uploadOk = 0;
                }
    
                // Check file size
                if ($_FILES["photos"]["size"][$i] > 2000000) {
                    echo "<script>alert('Sorry, your file is too large.')</script>";  //2000KB
                    echo "<script>window.setTimeout(function(){window.location.href='../view/addpost.php'}, 500);</script>";
                    $uploadOk = 0;
                }
    
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed.')</script>";
                    echo "<script>window.setTimeout(function(){window.location.href='../view/addpost.php'}, 500);</script>";
                    $uploadOk = 0;
                }
    
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "<script>alert('Sorry, your file was not uploaded.')</script>";
                    echo "<script>window.setTimeout(function(){window.location.href='../view/addpost.php'}, 500);</script>";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $target_file)) {
                        $fileName = htmlspecialchars(basename($_FILES["photos"]["name"][$i]));
                        // echo "The file ". $fileName . " has been uploaded. <br>";
                        $uploadedFiles++;
                        $fileUploadSuccess = true;

                        if($fileUploadSuccess){
                            $isSuccess = DbUtil::addImages($foreignId, $fileName);
                        }else{
                            $fileUploadSuccess = false;
                        }
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                        echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
                    }
                }
            }

            if(!$fileUploadSuccess){
                $deleteSuccess = DbUtil::deletePost($foreignId);
                if($deleteSuccess){
                    echo "<script>alert('Sorry, your file was not uploaded.')</script>";
                    echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
                }
            }else{
                echo "<script>alert('Ad uploaded successfully')</script>";
                echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
                // header('Location: ../view/profile.php');
            }
        }else{
            echo "<script>alert('Sorry, we could not upload your ad!')</script>";
            echo "<script>window.setTimeout(function(){window.location.href='../view/profile.php'}, 500);</script>";
        }

    }
?>