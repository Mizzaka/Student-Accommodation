<?php

    session_start(); 
    require_once('../model/dbutil.php');

    if(!(isset($_SESSION['user']) && ($_SESSION['user_type'] == 'student' || $_SESSION['user_type'] == 'landlord'))){
        header("Location: login.php");
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile Page</title>
<link rel="stylesheet" href="styles/style.css">
<style>
    /* Global styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        display: flex; /* Use flexbox to display cards side by side */
        justify-content: space-between; /* Ensure equal spacing between cards */
    }
    
    /* Profile Sidebar */
    .profile-sidebar {
        background-color: #fff;
        margin-left:-30px ;
        
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        flex: 0 0 30%; /* Set a fixed width for the sidebar */
    }
    
    .profile-sidebar h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }
    
    .profile-sidebar ul {
        list-style: none;
        padding: 0;
    }
    
    .profile-sidebar li {
        margin-bottom: 10px;
    }
    
    .profile-sidebar a {
        color: #333;
        text-decoration: none;
        font-size: 18px;
    }
    
    .profile-sidebar a:hover {
        color: #007bff;
    }
    
    /* Profile Content */
    .profile-content {
        background-color: #fff;
        
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        flex: 0 0 65%; /* Set a fixed width for the content */
    }
    
    .profile-content h3 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }
    
    .profile-content form {
        margin-bottom: 20px;
    }
    
    .profile-content label {
        display: block;
        color: #333;
        font-size: 18px;
        margin-bottom: 10px;
    }
    
    .profile-content input[type="text"],
    .profile-content input[type="password"] {
        width: 90%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    
    .profile-content button {
        background-color: #04b33e;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
    }
    
    .profile-content button:hover {
        background-color: #01d62f;
    }

/* Styles for the cart */
.cart-container {
      max-width: 1080px; /* Adjusted max-width */
      margin: 20px auto;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .cart-heading {
      margin-bottom: 10px;
  }
  .profile-sidebar ul {
    list-style-type: none;
    padding: 0;
}

.profile-sidebar li {
    padding: 20px 0; /* Adjust padding as needed */
}

.profile-sidebar li a {
    margin-left: 50px;
    text-decoration: none;
    color: black;
}

.profile-sidebar li.active {
    background-color: #f0f0f0; /* Change the background color to highlight */
}


    .requests-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px; /* Adding rounded corners to the table */
    overflow: hidden; /* Ensure that the border-radius is applied properly */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Adding a subtle shadow effect */
}

.requests-table th, .requests-table td {
    padding: 8px;
    border: none; /* Remove border from table cells */
}

.requests-table th {
    background-color: #f2f2f2;
    text-align: left;
    border-bottom: 1px solid #ddd; /* Add border only to table headers */
}

.approve-btn, .reject-btn {
    padding: 6px 10px;
    border: none;
    cursor: pointer;
}

.approve-btn {
    background-color: #34CC33;
    color: white;
    width: 90px;
    border-radius: 10rem;
}

.reject-btn {
    background-color: #f44336;
    color: white;
    margin-top: 5px;
    width: 90px;
    border-radius: 10rem;
}

/* Cart Container */
.cart-container {
    margin-top: 50px;
    background-color: #fff;
    padding: 40px;
    margin-left: 50px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    max-width: 85%;
}

.cart-heading {
    color: black;
    font-size: 24px;
    margin-bottom: 20px;
}

.requests-table {
    width: 100%;
    border-collapse: collapse;
}

.requests-table th, .requests-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.requests-table th {
    background-color: #f2f2f2;
}

.requests-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.requests-table tr:hover {
    background-color: #ddd;
}

.approve-btn {
    display: inline-block;
    padding: 8px 12px;
    margin-right: 5px;
    background-color: #00bd39;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}
.reject-btn{
    display: inline-block;
    padding: 8px 12px;
    margin-right: 5px;
    background-color: #c70000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.approve-btn:hover  {
    background-color: #01ce3e;
}

.reject-btn:hover{
    background-color: #810000;
}
.property-list {
    list-style: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.property-card {
    background-color: #ebf9eb;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    max-width: 350px; /* Adjust card width as needed */
    padding: 15px;
    margin: 30px;
    margin-left: 80px;
}

.property-card .dropdown {
    position: relative;
}

.property-card .dropdown .dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 100px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
}

.property-card .dropdown:hover .dropdown-content {
    display: block;
}

.property-card .dropdown .dropdown-content a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
}

.property-card .dropdown .dropdown-content a:hover {
    background-color: #00c559;
}


.property-card .card-banner {
    width: 85%;
    height: 200px; /* Adjust banner height as needed */
    border-radius: 10px 10px 0 0;
    overflow: hidden;
    margin-left: 25px;
}

.property-card .card-banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.property-card .card-content {
    padding: 10px;
}

.property-card .card-title {
    color: #333;
    font-size: 25px;
    margin-bottom: 10px;
}

.property-card .card-list {
    list-style: none;
    padding: 0;
    margin-bottom: 10px;
}

.property-card .card-list li {
    display: flex;
    align-items: center;
    color: #666;
    margin-bottom: 5px;
}

.property-card .card-list li ion-icon {
    margin-right: 0px;
}

.property-card .card-meta {
    display: flex;
    justify-content: space-between;
}

.property-card .meta-title {
    font-weight: bold;
    color: #333;
    
    
    
}

.property-card .meta-text {
    color: #666;
    margin-left: 80px;
    
    font-size: 25px;
}


    
</style>
    
</head>
<body>

<div class="container">
    <!-- Sidebar Start -->
    <div class="profile-sidebar">
        <h2>User Profile</h2>
        <ul>
            <li><a href="#" onclick="showProfile()">Profile Info</a></li>
            <li><a href="#" onclick="showChangePassword()">Change Password</a></li>
            <li><a href="#" onclick="showDelete()">Delete Account</a></li>
        </ul>
    </div>
    <!-- Sidebar End -->
    
    <!-- Profile Content Start -->
    <div class="profile-content" id="profileInfo">
        <h3>Profile Info</h3>
        <?php 
            if($_SESSION['user_type'] == 'student'){
                $student = DbUtil::getStudentDetails($_SESSION['user_id']);
        ?>
        <form action="../controller/editProfileController.php" method="post">
            <input class="profile-input" type="text" id="id" name="id" value="<?php echo $student->getId() ?>" readonly style="display: none;">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $student->getName() ?>" >
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $student->getEmail() ?>" >
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="contact" value="<?php echo $student->getContact() ?>" >
            <button type="submit" name="editprofile">Save Changes</button>
        </form>

        <?php } else{ 
            $landlord = DbUtil::getLandlordDetails($_SESSION['user_id']);
    ?>
        <form action="../controller/editProfileController.php" method="post">
             
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $landlord->getName() ?>" >
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $landlord->getEmail() ?>" >
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="contact" value="<?php echo $landlord->getContact() ?>" >
            <button type="submit" name="editprofile">Save Changes</button>
        </form>
        <?php } ?>
    </div>

    <div class="profile-content" id="changePassword" style="display: none;">
        <h3>Change Password</h3>
        <form action="../controller/editPasswordController.php" method="post">
            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter your current password">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" placeholder="Enter your new password">
            <label for="confirmPassword">Confirm New Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your new password">
            <button type="submit" name="editpass">Save Changes</button>
        </form>
    </div>

    <div class="profile-content" id="deleteAcc" style="display: none;">
        <h3>Delete Account</h3>
        <form action="../controller/deleteProfileController.php" method="post">
            <label for="confirmDelete">Enter Password to Confirm Deletion:</label>
            <input type="password" id="confirmDelete" name="confirmDelete" placeholder="Enter your password to confirm deletion">
            <button type="submit" name="deleteacc" style="background-color: #f44336;">Delete Account</button>
        </form>
    </div>
    <!-- Profile Content End -->

</div>
<?php if($_SESSION['user_type'] == 'landlord') { ?>
<div class="cart-container">
    <h2 class="cart-heading">Student Requests</h2>
    <table class="requests-table">
        <thead>
            <tr>
                <th>Ad ID</th>
                <th>Student Name</th>
                <th>Phone Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php $stdRequests = DbUtil::getStudentRequest($_SESSION['user_id']);
                    foreach($stdRequests as $stdRequest){
                ?>
            <tr>
                <td><?php echo $stdRequest->ad_id ?></td>
                <td><?php echo $stdRequest->std_name ?></td>
                <td><?php echo $stdRequest->std_contact ?></td>
                <td><?php echo $stdRequest->status ?></td>
                <td style="text-align: center;">
                    <a href="../controller/stdReqApproveController.php?id=<?php echo $stdRequest->id ?>&status=true" class="approve-btn">Approve</a>
                    <a href="../controller/stdReqApproveController.php?id=<?php echo $stdRequest->id ?>&status=false" class="reject-btn">Reject</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php } ?>


<?php if($_SESSION['user_type'] == 'landlord') {?>
<div class="cart-container">
    <h2 class="cart-heading">My Ads</h2>
    <section class="property" id="property">
        <div class="container">
            <ul class="property-list">
                <?php
                    $adDetails = DbUtil::getPost($_SESSION['user_id']);

                    foreach($adDetails as $adDetail){
                        $imagePaths = DbUtil::getImagePath($adDetail->id);
                ?>
                <li>
                    <div class="property-card">
                        <div class="dropdown dropdown-right">
                            <button class="dropbtn">...</button>
                            <div class="dropdown-content">
                                <a href="postedit.php?id=<?php echo $adDetail->id?>&landlord=<?php echo $adDetail->landlord?>">Edit Post</a>
                                <a href="#"
                                onclick="if (confirm('Are you sure you want to delete this post?')) { window.location.href = '../controller/deletePostController.php?id=<?php echo $adDetail->id?>'; }">Delete Post</a>
                            </div>
                        </div>
                        <figure class="card-banner">
                            <img src="../../assets/images/<?php echo $imagePaths[0]->image ?>" alt="Property Image" class="img-cover">
                        </figure>
                        <div class="card-content">
                            <h3 class="card-title"><?php echo $adDetail->location?></h3>
                            <ul class="card-list">
                                <li><ion-icon name="bed-outline"></ion-icon><?php echo $adDetail->bed?> Beds</li>
                                <li><ion-icon name="man-outline"></ion-icon><?php echo $adDetail->bath?> Baths</li>
                            </ul>
                            <div class="card-meta">
                                <div>
                                    
                                    <span class="meta-text">Rs.<?php echo $adDetail->price?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
                    }
                ?>
                <li>
                    <div class="property-card">
                        <div class="dropdown dropdown-right">
                            <button class="dropbtn">...</button>
                            <div class="dropdown-content">
                                <a href="#">Edit Post</a>
                                <a href="#">Delete Post</a>
                            </div>
                        </div>
                        <figure class="card-banner">
                            <img src="https://via.placeholder.com/800x533" alt="Property Image" class="img-cover">
                        </figure>
                        <div class="card-content">
                            <h3 class="card-title">Property Location</h3>
                            <ul class="card-list">
                                <li><ion-icon name="bed-outline"></ion-icon> 3 Beds</li>
                                <li><ion-icon name="man-outline"></ion-icon> 2 Baths</li>
                            </ul>
                            <div class="card-meta">
                                <div>
                                    
                                    <span class="meta-text">Rs. 100,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="property-card">
                        <div class="dropdown dropdown-right">
                            <button class="dropbtn">...</button>
                            <div class="dropdown-content">
                                <a href="#">Edit Post</a>
                                <a href="#">Delete Post</a>
                            </div>
                        </div>
                        <figure class="card-banner">
                            <img src="https://via.placeholder.com/800x533" alt="Property Image" class="img-cover">
                        </figure>
                        <div class="card-content">
                            <h3 class="card-title">Property Location</h3>
                            <ul class="card-list">
                                <li><ion-icon name="bed-outline"></ion-icon> 3 Beds</li>
                                <li><ion-icon name="man-outline"></ion-icon> 2 Baths</li>
                            </ul>
                            <div class="card-meta">
                                <div>
                                    
                                    <span class="meta-text">Rs. 100,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="property-card">
                        <div class="dropdown dropdown-right">
                            <button class="dropbtn">...</button>
                            <div class="dropdown-content">
                                <a href="#">Edit Post</a>
                                <a href="#">Delete Post</a>
                            </div>
                        </div>
                        <figure class="card-banner">
                            <img src="https://via.placeholder.com/800x533" alt="Property Image" class="img-cover">
                        </figure>
                        <div class="card-content">
                            <h3 class="card-title">Property Location</h3>
                            <ul class="card-list">
                                <li><ion-icon name="bed-outline"></ion-icon> 3 Beds</li>
                                <li><ion-icon name="man-outline"></ion-icon> 2 Baths</li>
                            </ul>
                            <div class="card-meta">
                                <div>
                                    
                                    <span class="meta-text">Rs. 100,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End of sample card -->
            </ul>
        </div>
    </section>
</div>
<?php } ?>


<script>
function showProfile() {
    document.getElementById("profileInfo").style.display = "block";
    document.getElementById("changePassword").style.display = "none";
    document.getElementById("deleteAcc").style.display = "none";
}

function showChangePassword() {
    document.getElementById("profileInfo").style.display = "none";
    document.getElementById("changePassword").style.display = "block";
    document.getElementById("deleteAcc").style.display = "none";
}

function showDelete(){
    document.getElementById("deleteAcc").style.display = "block";
    document.getElementById("profileInfo").style.display = "none";
    document.getElementById("changePassword").style.display = "none";
}
</script>

</body>
</html>
