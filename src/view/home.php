<?php

    session_start();
    require_once('../model/dbutil.php');

    if(!isset($_SESSION['user'])){        
        header('Location: login.php');
    }
    if(isset($_SESSION['user']) && $_SESSION['user_type'] == 'admin'){
        session_destroy();
        header("Location: login.php");
    }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Accommodation - NSBM</title>
<link rel="stylesheet" href="../../public/styles/style.css">
<!-- google font link -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'League Spartan', sans-serif;
        
    }

    .map-full-container {
        max-width: auto; /* Adjusted max-width */
        margin: 100px auto;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
    }

    .map-container{
        height: 100vh;
        width: 70%;
        float: right;
    }

    .locations-container {
        height: 100vh;
        width: 30%;
        overflow-y: auto;
        float: left;
        background-color: #f2f2f2;

    }

    .locations-tab {
        width: 120px; /* Adjust width as needed */
        display: inline-block;
        background-color: #ddd;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        margin-right: 10px; /* Increased margin for spacing */
        transition: background-color 0.3s ease;
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        margin-left: 10px;
    }


    .locations-tab:hover {
        background-color: #ccc;
    }

    .locations-tab.active {
        background-color: #fff;
        border-bottom: 2px solid #34CC33;
    }

    .locations-tab i {
        margin-right: 5px;
    }

    .locations-list {
        list-style-type: none;
        padding: 0;
    }

    .locations-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }

    .locations-item:hover {
        background-color: #ccc;
    }
    .location-card {
        display: flex;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: .5rem;
    }

    .location-card img {
        width: 150px; /* Adjust the image width as needed */
        height: auto; /* Adjust the image height as needed */
        margin-right: 10px;
        border-radius: .5rem;

    }

    .location-card-details {
        flex-grow: 1;
    }
    .vertical-line {
        width: 1px;
        height: 100%;
        background-color: #ddd;
        margin-right: 10px;
    }

    .location-card-details h3 {
        margin: 0;
        font-size: 16px;
    }

    .location-card-details p {
        margin: 5px 0;
    }



</style>
</head>
<body>
    <!-- #HEADER -->
    <?php include_once('header2.php'); ?>

    <div class="map-full-container">
        <div class="locations-container">

            <?php if($_SESSION['user_type'] == 'warden'){ ?>
                <div class="locations-tab"><i class="fas fa-bookmark"></i> All Ads</div>
                <ul id="locationList" class="locations-content">

                    <?php $posts = DbUtil::getAllPosts();
                            foreach($posts as $post){
                                $imagePaths = DbUtil::getImagePath($post->id);
                    ?>
                        <li class="locations-item" onclick="showLocationOnMap(<?php echo $post->latitude ?>, <?php echo $post->longitude ?>)">
                
                            <div class="location-card">
                                <img src="../../assets/images/<?php echo $imagePaths[0]->image ?>" alt="New York City">
                                <div class="location-card-details">
                                    <h3><?php echo $post->location ?></h3>
                                    <p>Beds: <?php echo $post->bed ?></p>
                                    <p>Category: <?php echo $post->category ?></p>
                                    <p>Price: Rs.<?php echo $post->price ?></p>
                                    <p>Status: <?php echo $post->status ?></p>
                                    <a href="card.php?id=<?php echo $post->id?>" style="text-decoration: underline">View details</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else{?>
                <div class="locations-tab"><i class="fas fa-bookmark"></i> All Ads</div>
                <ul id="locationList" class="locations-content">

                    <?php $posts = DbUtil::getApprovedPosts();
                            foreach($posts as $post){
                                $imagePaths = DbUtil::getImagePath($post->id);
                    ?>
                        <li class="locations-item" onclick="showLocationOnMap(<?php echo $post->latitude ?>, <?php echo $post->longitude ?>)">
                
                            <div class="location-card">
                                <img src="../../assets/images/<?php echo $imagePaths[0]->image ?>" alt="New York City">
                                <div class="location-card-details">
                                    <h3><?php echo $post->location ?></h3>
                                    <p>Beds: <?php echo $post->bed ?></p>
                                    <p>Category: <?php echo $post->category ?></p>
                                    <p>Price: Rs.<?php echo $post->price ?></p>
                                    <?php if($_SESSION['user_type'] == 'student') { ?>
                                        <a href="card.php?id=<?php echo $post->id?>&landlord=<?php echo $post->landlord ?>" style="text-decoration: underline">View details</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

            
        </div>
        <div class="map-container" id="map"></div>
    
    </div>

    <!--#FOOTER -->
    <?php include_once('footer.html') ?>

    <!-- #BACK TO TOP -->

    <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
        <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
    </a>
    <!-- custom js link -->
    <script src="./scripts/script.js" defer></script>
    <!-- ionicon link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 11, // Adjust the zoom level as needed
                center: { lat: 6.8416, lng: 80.0034 }, // Centered on Sri Lanka
            });
            window.map = map; // Make map accessible globally


            // Add markers for each location
            const locationItems = document.querySelectorAll('#locationList .locations-item');
            locationItems.forEach(item => {
                const [latitude, longitude] = item.getAttribute('onclick').match(/\d+\.\d+/g).map(Number);
                const marker = new google.maps.Marker({
                    position: { lat: latitude, lng: longitude },
                    map,
                    title: `${latitude}, ${longitude}`
                });
            });
        }

        // Function to show location on map
        function showLocationOnMap(latitude, longitude) {
            const map = window.map;
            map.setCenter({ lat: latitude, lng: longitude });
            new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map,
                title: `${latitude}, ${longitude}`
            });
        }

        // Function to show location on map and zoom in/out
        function showLocationOnMap(latitude, longitude) {
                const map = window.map;
                const zoomLevel = map.getZoom(); // Get the current zoom level

                if (zoomLevel === 15) {
                    // If the map is already zoomed in, zoom out to default size
                    map.setZoom(11); // Set the default zoom level
                } else {
                    // Otherwise, zoom in to show the selected location
                    map.setCenter({ lat: latitude, lng: longitude });
                    map.setZoom(15); // Set the zoom level for the selected location
                }
        } 

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdr0Aijr7M2pIqpX43Hsk2erMP4mYtoxc&callback=initMap" async defer></script>
</body>
</html>
