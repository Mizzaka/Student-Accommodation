<?php     

require_once('../model/dbconnect.php');
require_once('../model/Student.php');
require_once('../model/Landlord.php');
require_once('../model/ImagePaths.php');
require_once('../model/StudentRequests.php');
require_once('../model/AdDetails.php');




class DbUtil {

    public static function getStudent($email, $password){
        $conn = DbConnect::dbConnect();
        $student = null;

        try{
            $sql = "select * from student where email = '$email' and password = '$password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                // $student = new Student($row['id'], $row['name'], $row['email'], $row['contact']);
                $student = new Student();
                $student->setId($row['id']);
                $student->setName($row['name']);
                $student->setEmail($row['email']);
                $student->setContact($row['contact']);
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        
        return $student;
    }

    public static function getLandlord($email, $password){
        $conn = DbConnect::dbConnect();
        $landlord = null;

        try{
            $sql = "select * from landlord where email = '$email' and password = '$password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $landlord = new Landlord();
                $landlord->setId($row['id']);
                $landlord->setName($row['name']);
                $landlord->setEmail($row['email']);
                $landlord->setContact($row['contact']);
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        
        return $landlord;
    }

    public static function getWarden($email, $password){
        $conn = DbConnect::dbConnect();
        $result = false;

        try{
            $sql = "select * from warden where email = '$email' and password = '$password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $result = true;
            }else $result = false;
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $result;
    }

    public static function getAdmin($email, $password){
        $conn = DbConnect::dbConnect();
        $result = false;

        try{
            $sql = "select * from admin where email = '$email' and password = '$password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $result = true;
            }else $result = false;
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $result;
    }

    public static function registerUser($name, $email, $contact, $password, $type){
        $conn = DbConnect::dbConnect();
        $result = false;

        try{
            if($type == 'student'){
                try{
                    $sql = "insert into student (name, email, password, contact) values ('$name', '$email', '$password', '$contact')";
                    $result = mysqli_query($conn, $sql); //since its an insert query it returns a boolean.
                }catch(mysqli_sql_exception){
                    echo "<script>alert('An error occurred. Try again later');</script>";
                }
            }elseif($type == 'landlord'){
                try{
                    $sql = "insert into landlord (name, email, password, contact) values ('$name', '$email', '$password', '$contact')";
                    $result = mysqli_query($conn, $sql);
                }catch(mysqli_sql_exception){
                    echo "<script>alert('An error occurred. Try again later');</script>";
                }
            }else{
                try{
                    $sql = "insert into warden (name, email, password, contact) values ('$name', '$email', '$password', '$contact')";
                    $result = mysqli_query($conn, $sql);
                }catch(mysqli_sql_exception){
                    echo "<script>alert('An error occurred. Try again later');</script>";
                }
            }
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $result;
    }

    public static function getStudentDetails($id){
        $conn = DbConnect::dbConnect();
        $student = null;

        try{
            $sql = "select * from student where id = '$id' ";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $student = new Student();
                $student->setId($row['id']);
                $student->setName($row['name']);
                $student->setEmail($row['email']);
                $student->setContact($row['contact']);
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        
        return $student;
    }

    public static function getLandlordDetails($id){
        $conn = DbConnect::dbConnect();
        $landlord = null;

        try{
            $sql = "select * from landlord where id = '$id' ";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $landlord = new Landlord();
                $landlord->setId($row['id']);
                $landlord->setName($row['name']);
                $landlord->setEmail($row['email']);
                $landlord->setContact($row['contact']);
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        
        return $landlord;
    }

    public static function editStudentProfile($id, $name, $email, $contact){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "update student set name = '$name', email = '$email', contact = '$contact' where id = '$id' ";
            $result = mysqli_query($conn, $sql);

            if($result){
                $isSuccess = true;
            }else $isSuccess = false;
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function editLandlordProfile($id, $name, $email, $contact){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "update landlord set name = '$name', email = '$email', contact = '$contact' where id = '$id' ";
            $result = mysqli_query($conn, $sql);

            if($result){
                $isSuccess = true;
            }else $isSuccess = false;
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function editStudentPass($id, $newpass, $curpass){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "select * from student where id = '$id' and password = '$curpass'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0){
                $q = "update student set password = '$newpass' where id = '$id '";
                $rs = mysqli_query($conn, $q);
                if($rs){
                    $isSuccess = true;
                }else $isSuccess = false;
            }else $isSuccess = false;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later . $e');</script>";
        }
        return $isSuccess;
    }

    public static function editLandlordPass($id, $newpass, $curpass){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "select * from landlord where id = '$id' and password = '$curpass'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0){
                $q = "update landlord set password = '$newpass' where id = '$id '";
                $rs = mysqli_query($conn, $q);
                if($rs){
                    $isSuccess = true;
                }else $isSuccess = false;
            }else $isSuccess = false;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function deleteStudentAcc($id, $curpass){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "select * from student where id = '$id' and password = '$curpass'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0){
                $q = "delete from student where id = '$id' ";
                $rs = mysqli_query($conn, $q);
                if($rs){
                    $isSuccess = true;
                }else $isSuccess = false;
            }else $isSuccess = false;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function deleteLandlordAcc($id, $curpass){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "select * from landlord where id = '$id' and password = '$curpass'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0){
                $q = "delete from landlord where id = '$id' ";
                $rs = mysqli_query($conn, $q);
                if($rs){
                    $isSuccess = true;
                }else $isSuccess = false;
            }else $isSuccess = false;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function addPost($id, $bed, $baths, $category, $phone, $price, $description, $location, $latitude, $longitude){
        $conn = DbConnect::dbConnect();
        $foreignId = null;

        try{
            $sql = "insert into landlord_ad values (0, '$bed', '$baths', '$category', '$phone', '$price', '$description', '$location', 'pending', '$id', ' ', '$latitude', '$longitude')";
            $result = mysqli_query($conn, $sql);

            if($result){
                // $row = mysqli_fetch_assoc($result);
                // $foreignId = $row['id'];
                $foreignId = mysqli_insert_id($conn);   //returns the id of an auto incremented row
            }else $foreignId = null;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $foreignId;
    }

    public static function addImages($ad_Id, $path){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "insert into add_image values (0, '$ad_Id', '$path') ";
            $result = mysqli_query($conn, $sql);

            if($result){
                $isSuccess = true;
            }else $isSuccess = false;
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function deletePost($id){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "delete from landlord_ad where id = '$id'";
            $result = mysqli_query($conn, $sql);

            if($result){
                $isSuccess = true;
            }else $isSuccess = false;
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function deleteImagePath($id){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "delete from add_image where ad_id = '$id'";
            $result = mysqli_query($conn, $sql);

            if($result){
                $isSuccess = true;
            }else $isSuccess = false;
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function updatePost($id, $bed, $bath, $category, $phone, $price, $description, $location, $latitude, $longitude){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "update landlord_ad set bed = '$bed', baths = '$bath', category = '$category', phone = '$phone', price = '$price', 
            description = '$description', location = '$location', latitude = '$latitude', longitude = '$longitude' where id = '$id' ";
            $result = mysqli_query($conn, $sql);

            if($result){
                $isSuccess = true;
            }else {
                $isSuccess = false;
            }
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function getPost($landlordid){
        $conn = DbConnect::dbConnect();
        $adDetails = [];

        try{
            $sql = "select * from landlord_ad where landlord_id = '$landlordid' ";
            $result = mysqli_query($conn, $sql);

            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $adDetail = new AdDetails();
                    $adDetail->setId($row['id']);
                    $adDetail->setBed($row['bed']);
                    $adDetail->setBath($row['baths']);
                    $adDetail->setCategory($row['category']);
                    $adDetail->setPhone($row['phone']);
                    $adDetail->setPrice($row['price']);
                    $adDetail->setDescription($row['description']);
                    $adDetail->setLocation($row['location']);
                    $adDetail->setStaus($row['status']);
                    $adDetail->setLatitude($row['latitude']);
                    $adDetail->setLongitude($row['longitude']);

                    $adDetails[] = $adDetail;   //adding each row to the array
                }
            }
        } catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }

        return $adDetails;
    }

    public static function getOnePost($id){
        $conn = DbConnect::dbConnect();
        $adDetail = null;

        try{
            $sql = "select * from landlord_ad where id = '$id' ";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $adDetail = new AdDetails();
                $adDetail->setId($row['id']);
                $adDetail->setBed($row['bed']);
                $adDetail->setBath($row['baths']);
                $adDetail->setCategory($row['category']);
                $adDetail->setPhone($row['phone']);
                $adDetail->setPrice($row['price']);
                $adDetail->setDescription($row['description']);
                $adDetail->setLocation($row['location']);
                $adDetail->setStaus($row['status']);
                $adDetail->setLandlord($row['landlord_id']);
                $adDetail->setLatitude($row['latitude']);
                $adDetail->setLongitude($row['longitude']);
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }

        return $adDetail;
    }

    public static function getImagePath($adId){
        $conn = DbConnect::dbConnect();
        $imagePaths = [];

        try{
            $sql = "select * from add_image where ad_id = '$adId' ";
            $result = mysqli_query($conn, $sql);

            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $imagePath = new ImagePaths();
                    $imagePath->setImage($row['image_path']);

                    $imagePaths[] = $imagePath;
                }
            }
        } catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $imagePaths;
    }

    public static function addBlog($title, $description, $image){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "insert into admin_blog values (0, '$title', '$description', '$image') ";
            $result = mysqli_query($conn, $sql);
            if($result) $isSuccess = true;
            else $isSuccess = false;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function getBlog(){
        $conn = DbConnect::dbConnect();
        $blogs = [];

        try{
            $sql = "select * from admin_blog";
            $result = mysqli_query($conn, $sql);
            
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $blog = new Blog();
                    $blog->setTitle($row['title']);
                    $blog->setDescription($row['description']);
                    $blog->setImage($row['image']);

                    $blogs[] = $blog;
                }
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $blogs;
    }

    public static function wardenApproval($id, $status, $description){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "update landlord_ad set status = '$status', reason = '$description' where id = '$id' ";
            $result = mysqli_query($conn, $sql);

            if($result){
                $isSuccess = true;
            }else $isSuccess = false;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function getAllPosts(){
        $conn = DbConnect::dbConnect();
        $posts = [];

        try{
            $sql = "select * from landlord_ad";
            $result = mysqli_query($conn, $sql);

            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $post = new AdDetails();
                    $post->setId($row['id']);
                    $post->setBed($row['bed']);
                    $post->setBath($row['baths']);
                    $post->setCategory($row['category']);
                    $post->setPhone($row['phone']);
                    $post->setPrice($row['price']);
                    $post->setDescription($row['description']);
                    $post->setLocation($row['location']);
                    $post->setStaus($row['status']);
                    $post->setLandlord($row['landlord_id']);
                    $post->setLatitude($row['latitude']);
                    $post->setLongitude($row['longitude']);

                    $posts[] = $post;   //adding each row to the array
                }
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $posts;
    }

    public static function getApprovedPosts(){
        $conn = DbConnect::dbConnect();
        $posts = [];

        try{
            $sql = "select * from landlord_ad where status = 'approved' ";
            $result = mysqli_query($conn, $sql);

            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $post = new AdDetails();
                    $post->setId($row['id']);
                    $post->setBed($row['bed']);
                    $post->setBath($row['baths']);
                    $post->setCategory($row['category']);
                    $post->setPhone($row['phone']);
                    $post->setPrice($row['price']);
                    $post->setDescription($row['description']);
                    $post->setLocation($row['location']);
                    $post->setStaus($row['status']);
                    $post->setLandlord($row['landlord_id']);
                    $post->setLatitude($row['latitude']);
                    $post->setLongitude($row['longitude']);

                    $posts[] = $post;   //adding each row to the array
                }
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $posts;
    }

    public static function addStudentRequest($ad_id, $std_id, $landlord_id, $std_name, $std_contact){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "insert into student_request values (0, '$std_id', '$ad_id', '$landlord_id', '$std_name', '$std_contact', 'pending') ";
            $result = mysqli_query($conn, $sql);

            if($result){
                $isSuccess = true;
            }else $isSuccess = false;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }

    public static function getStudentRequest($landlord_id){
        $conn = DbConnect::dbConnect();
        $stdRequests = [];

        try{
            $sql = "select * from student_request where landlord_id = '$landlord_id' ";
            $result = mysqli_query($conn, $sql);

            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $stdRequest = new StudentRequest();
                    $stdRequest->setId($row['id']);
                    $stdRequest->setAdId($row['ad_id']);
                    $stdRequest->setStdName($row['std_name']);
                    $stdRequest->setStdContact($row['std_contact']);
                    $stdRequest->setStatus($row['status']);

                    $stdRequests[] = $stdRequest;   //adding each row to the array
                }
            }
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $stdRequests;
    }

    public static function updateStdRequest($id, $status){
        $conn = DbConnect::dbConnect();
        $isSuccess = false;

        try{
            $sql = "update student_request set status = '$status' where id = '$id' ";
            $result = mysqli_query($conn, $sql);

            if($result) $isSuccess = true;
            else $isSuccess = false;
        }catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $isSuccess;
    }


    public static function getRelatedAdIds($landlordId){
        $conn = DbConnect::dbConnect();
        $adIds = [];
    
        try{
            $sql = "select id from landlord_ad where landlord_id = '$landlordId'";
            $result = mysqli_query($conn, $sql);
    
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $adIds[] = $row['id'];
                }
            }
        }catch(mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        }
        return $adIds;
    }
}

?>