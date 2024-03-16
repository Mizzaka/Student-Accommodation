<?php

  session_start();
  require_once('../model/dbutil.php');

  if(isset($_SESSION['user'])){
    if($_SESSION['user_type'] !== 'landlord'){
        header('Location: home.php');
    }

    if(isset($_GET['landlord']) && isset($_GET['id'])){
        $adIds = DbUtil::getRelatedAdIds($_SESSION['user_id']);
        $notAllowed = true;

        foreach($adIds as $adId){
            if($_GET['id'] == $adId){
                $notAllowed = false;
                break;
            }
        }

        if($notAllowed){
            header('Location: index.php');
        }
    }else{
      header('Location: profile.php');
    }
  }else header('Location: login.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Accommodation - NSBM</title>
  <link rel="stylesheet" href="styles.css">
  <!-- favicon -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

<style>
   /* Global styles */
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f5f5f5;
  color: #333;
}

.container {
  max-width: 100%;
  margin: 0 auto;
  padding: 20px;
}

hr {
  border: none;
  border-top: 1px solid #ccc;
}

h2 {
  color: #333;
}

form {
  margin-bottom: 40px;
}

.product-gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 30px;
    }

    .main-image,
    .thumbnails {
      flex: 1;
      width: 100%;
    }

    .main-image img {
      margin-left: 10px;
  background-size: cover;
  width: 100%; /* Update to take 100% width */
  height: 100%; /* Set a fixed height for better consistency */
  object-fit: cover; /* Maintain aspect ratio and cover the container */
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.thumbnails {
  display: flex;
  flex-wrap: wrap; /* Change from column to row for horizontal alignment */
  gap: 20px;/* Add space between thumbnails */
}

.thumbnails img {
 
  width: 48%; /* Set width to 48% for each thumbnail to leave space for gap */
  height: auto; /* Allow the height to adjust based on the width */
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: transform 0.3s ease;
}

/* Maintain hover effect */
.thumbnails img:hover {
  transform: scale(1.1);
}

/* Form styles */
form {
  margin-left: 0%;
  margin-right: 0%;
  background-color: #fff;
  padding: 80px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 90%;
}

form h2 {
  margin-bottom: 20px;
}

form label {
  font-weight: bold;
}

form input[type="text"],
form select,
form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

form button:hover {
  background-color: #0056b3;
}

/* Map styles */
.map {
  margin-top: 40px;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.map h3 {
  margin-bottom: 20px;
}

.map iframe {
  width: 100%;
  height: 400px;
  border: none;
  border-radius: 5px;
}

/* Styles for the added part under Accommodation Details section */

.request-section {
  margin-top: 40px;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.request-section h2 {
  color: black;
  margin-bottom: 20px;
}

.request-section textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  resize: vertical;
}

.request-section button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.request-section button:hover {
  background-color: #0056b3;
}

.request-section .line {
  border: none;
  border-top: 1px solid #ccc;
}
.custom-product-details-card {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.custom-product-details-card h2 {
  color: #333;
  margin-bottom: 20px;
}

.custom-product-details-card label {
  font-weight: bold;
}

.custom-product-details-card p {
  margin-left: 100px;
  margin-top: -17px;
}

.custom-product-details-card p:last-child {
  margin-bottom: 10px;
}




</style>
</head>
<body>   
    

<div class="container">
    <h1>Student Accommodation - NSBM</h1>
     <div class="product-gallery">
     <?php
     if(isset($_GET['id'])) {
          $id = $_GET['id'];
          $imagePaths = DbUtil::getImagePath($id);
      ?>
        <div class="main-image">
          <img src="../../assets/images/<?php echo $imagePaths[0]->image ?>" alt="Main Image">
        </div>

        <div class="thumbnails">
        <?php
          for($i = 1; $i < count($imagePaths); $i++){
      ?> 
        
          <img src="../../assets/images/<?php echo $imagePaths[$i]->image ?>" alt="Thumbnail 1">
          
          <!-- Add more thumbnails if needed -->
        
        <?php }} ?>
        </div>
      </div>


      <div class="custom-product-details-card">
        <h2>Accommodation Details</h2><br><br>
        <?php
        if(isset($_GET['id'])) {
          $id = $_GET['id'];
          $adDetail = DbUtil::getOnePost($id);
      ?>
        <label for="location">Location:</label>
        <p id="location"><?php echo $adDetail->location ?></p>
    
        <label for="beds">Beds:</label>
        <p id="beds"><?php echo $adDetail->bed ?></p>
    
        <label for="baths">Baths:</label>
        <p id="baths"><?php echo $adDetail->bath ?></p>
    
        <label for="category">Category:</label>
        <p id="category"><?php echo $adDetail->category ?></p>
    
        <label for="contact">Contact:</label>
        <p id="contact"><?php echo $adDetail->phone ?></p>
    
        <label for="price">Price (Rs.):</label>
        <p id="price"><?php echo $adDetail->price ?></p>
    
        <label for="description">Description:</label>
        <p id="description"><?php echo $adDetail->description ?></p>
        
        <?php } ?>
          


    <form>
      <h2>Accommodation Details</h2>
      <label for="location">Location:</label>
      <input type="text" id="location" name="location" placeholder="Great Location" required>

      <label for="beds">Beds:</label>
      <select id="beds" name="beds" required>
        <option value="">Select an option</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <!-- Add more bed options if needed -->
      </select>

      <label for="baths">Baths:</label>
      <select id="baths" name="baths" required>
        <option value="">Select an option</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <!-- Add more bath options if needed -->
      </select>

      <label for="category">Category:</label>
      <select id="category" name="category" required>
        <option value="">Choose category</option>
        <option value="female">Female</option>
        <option value="male">Male</option>
      </select>

      <label for="contact">Contact:</label>
      <input type="text" id="contact" name="contact" placeholder="Phone Number" required>

      <label for="price">Price (Rs.):</label>
      <input type="text" id="price" name="price" placeholder="Your Price Here" required>

      <label for="description">Description:</label>
      <textarea id="description" name="description" placeholder="Description" required></textarea>

      <button type="submit">Save Changes</button>
    </form>

    
  


    <div class="map">
      <h3>Location on Map</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31602.27472649562!2d-122.41953611722589!3d37.77492953078167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sGolden%20Gate%20Bridge!5e0!3m2!1sen!2sus!4v1647554956559!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</body>
</html>
