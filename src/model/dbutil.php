<?php

require_once('../model/dbconnect.php');
require_once('../model/Student.php');


class DbUtil {

    public static function getStudent($email, $password){
        $conn = DbConnect::dbConnect();
        $student = null;

        try{
            $sql = "SELECT * FROM student WHERE email = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $student = new Student();
                $student->setId($row['id']);
                $student->setName($row['name']);
                $student->setEmail($row['email']);
                $student->setContact($row['contact']);
            }
        } catch (mysqli_sql_exception $e){
            echo "<script>alert('An error occurred. Try again later');</script>";
        } finally {
            $stmt->close();
            $conn->close();
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




}

