<?php

require_once('../model/dbutil.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Validate form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $confirm_password = isset($_POST['repass']) ? $_POST['repass'] : '';
    
    // Check if user type is selected
    if (isset($_POST['Student']) && $_POST['Student'] == "on") {
        $type = 'student';
    } elseif (isset($_POST['Landlord']) && $_POST['Landlord'] == "on") {
        $type = 'landlord';
    } else {
        // Neither student nor landlord selected
        echo "<script>alert('Please select either Student or Landlord')</script>";
        exit; // Stop execution if user type is not selected
    }

    
    // Call the registerUser method from DbUtil class
    $result = DbUtil::registerUser($name, $email, $contact, $password, $type);

    // Check the result and display appropriate message
    if ($result) {
        // Redirect to the login page after successful registration
        header("Location:../view/Login.php");
        exit;
    } else {
        echo "<script>alert('Something went wrong')</script>";
    }
}

?>

