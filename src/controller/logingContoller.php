<?php

require_once('../model/dbutil.php');

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Attempt to retrieve a Student object
    $student = DbUtil::getStudent($email, $password);

    // Check if the Student object exists
    if($student != null) {
        // Student found, redirect to appropriate page based on user type
        header("Location: test.php");
        exit;
    } else {
        // Student not found, display error message
        echo "<script>alert('Invalid email or password')</script>";
    }
}

// Redirect back to the login page if the form was not submitted
header("Location: ../view/login.php");
exit;

?>

