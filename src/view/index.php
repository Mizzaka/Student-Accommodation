<?php

  require_once('../model/dbutil.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Accommodation - NSBM</title>
  <!-- <link rel="icon" type="image/x-icon" href="./assets/logo/favicon.ico"> -->
  <link rel="stylesheet" href="../../public/styles/index.css">


  <!-- favicon -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap"rel="stylesheet">
</head>
<style>

  .post-description-container::-webkit-scrollbar {
    width: 4px; /* Width of the scrollbar */
    height: 2px; /* Height of the scrollbar */
}

.post-description-container::-webkit-scrollbar-thumb {
    background-color: #34CC33; /* Color of the scrollbar thumb */
    border-radius: 10px; /* Border radius of the scrollbar thumb */
}

.post-description-container::-webkit-scrollbar-track {
    background-color: transparent; /* Color of the scrollbar track */
    border-radius: 10px; /* Border radius of the scrollbar track */
}


</style>

<body id="top">

<?php include_once('header.php'); ?>
  
  <main>
    <article class="article">

      <!-- #HERO -->
      <section class="section hero" aria-label="hero">
        <div class="container">
          <div class="hero-bg">
            <div class="hero-content">
              <h1 class="h1 hero-title">Accommodation  for <span class="span"> NSBM  </span> Student</h1>
              <p class="hero-text">
                A great plateform to buy, sell and rent your properties without any agent or commisions.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!--  #SERVICE -->
      <section class="section service" aria-label="service">
        <div class="container">
          <h2 class="h2 section-title">How It Works</h2>
          <p class="section-text">
            A great plateform to buy, sell and rent your properties without any agent or commisions.
          </p>
          <ul class="service-list">
            <li>
              <div class="service-card">
                <div class="card-icon">
                  <ion-icon name="home-outline"></ion-icon>
                </div>
                <h3 class="h3 card-title">Evaluate Property</h3>
                <p class="card-text">
                  If the distribution of letters and 'words' is random, the reader will not be distracted from making.
                </p>
              </div>
            </li>

            <li>
              <div class="service-card">
                <div class="card-icon">
                  <ion-icon name="briefcase-outline"></ion-icon>
                </div>
                <h3 class="h3 card-title">Meeting with Agent</h3>
                <p class="card-text">
                  If the distribution of letters and 'words' is random, the reader will not be distracted from making.
                </p>
              </div>
            </li>

            <li>
              <div class="service-card">
                <div class="card-icon">
                  <ion-icon name="key"></ion-icon>
                </div>
                <h3 class="h3 card-title">Close the Deal</h3>
                <p class="card-text">
                  If the distribution of letters and 'words' is random, the reader will not be distracted from making.
                </p>
              </div>
            </li>

          </ul>

        </div>
      </section>
      <br>
     
      <section id="aboutus">
        <div class="about-section">
          <div class="inner-container">
              <h1>About Us</h1>
              <p class="text">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus velit ducimus, enim inventore earum, eligendi nostrum pariatur necessitatibus eius dicta a voluptates sit deleniti autem error eos totam nisi neque voluptates sit deleniti autem error eos totam nisi neque.
              </p>
          </div>
      </div>
      </section>

      <section class="property" id="property">
        <div class="container">
          <h2 class="h2 section-title">Blog Posts</h2>
        </div>
      </section>

      <section id="blogs">
        <div class="post container">

          <?php 
            $blogs = DbUtil::getBlog();

            foreach($blogs as $blog){
          ?>        
            <!-- Post 1 -->
            <div class="post-box food">
              <img src="../../assets/blogimages/<?php echo $blog->image?>" alt="" class="post-img">
              <br>
              <a href="#" class="post-title"><?php echo $blog->title ?></a>
              <div class="post-description-container">
                  <p class="post-description"><?php echo $blog->description ?></p>
              </div>
            </div>
          <?php } ?>   

        </div>
      </section>

    </article>
  </main>
<?php include_once('footer.html') ?>

  <!-- custom js link -->
  <script src="./assets/js/script.js" defer></script>
  <!-- ionicon link -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>