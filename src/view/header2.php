
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accommodation</title>

  <!-- favicon -->
 
  <!-- custom css link -->

  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* Internal CSS styles */
    body {
      font-family: 'League Spartan', sans-serif;
      margin: 0;
      padding: 0;
      
    }

    .container {
      width: 100%;
      margin: 0 auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
    }

    .logo {
      font-size: 1.5rem;
      text-decoration: none;
      color: #004d1d;
      display: flex;
      align-items: center;
      margin-left:50px;
    }

    .navbar-list {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      margin-left: -520px;
    }

    .navbar-list li {
      margin-right: 20px;
    }

    .navbar-link {
      text-decoration: none;
      color: #004d1d;
      font-weight: 500;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      background-color: #00b32d;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #3aff20;
    }

    .nav-toggle-btn {
      background: none;
      border: none;
      cursor: pointer;
      display: none;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar-list {
        flex-direction: column;
      }

      .navbar-list li {
        margin-right: 0;
        margin-bottom: 10px;
      }

      .nav-toggle-btn {
        display: block;
      }
    }

  .btn.btn-secondary {
  padding: 10px 20px;
  border: none;
  background-color: #d85600;
  color: #fff;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-right: 50px;
}

.btn.btn-secondary:hover {
  background-color: #e08e30;
}


  </style>
</head>

<body id="top">
  
  <!-- #HEADER -->

  <header class="header" data-header>
    <div class="container">

      <a href="index.php" class="logo">
        <ion-icon name="#"></ion-icon> Student <br> Accommodation
      </a>

      
        <ul class="navbar-list">


        <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] !== 'admin') {?>
          <li>
            <a href="home.php" class="navbar-link" data-nav-link>Map</a>
          </li>
          <?php } ?>

          <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'landlord'){ ?>
          <li>
            <a href="addpost.php" class="navbar-link" data-nav-link>Post your Ad</a>
          </li>
          <?php }?>

          <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){ ?>
          <li>
            <a href="addblogpost.php" class="navbar-link" data-nav-link>Add a blog</a>
          </li>
          <?php }?>

          <?php if(isset($_SESSION['user']) && ($_SESSION['user_type'] == 'student' || $_SESSION['user_type'] == 'landlord')){ ?>
          <li>
            <a href="profile.php" class="navbar-link" data-nav-link>Profile</a>
          </li>
          <li>
          <?php }?>

            <a href="index.php#aboutus" class="navbar-link" data-nav-link>About Us</a>
          </li>
          <li>
            <a href="index.php#blogs" class="navbar-link" data-nav-link>Blogs</a>
          </li>
        </ul>
      </nav>


      <?php if(!isset($_SESSION['user'])){ ?>
      <button onclick="window.location.href = 'login.php'" class="btn btn-secondary">Login</button>
      <?php } else {?>
        <form action="index.php" method="post">
          <button type="submit" name="logout" class="btn btn-secondary">Logout</button>
        </form>
      <?php } ?>

      <button class="nav-toggle-btn" aria-label="Toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true" class="menu-icon"></ion-icon>
        <ion-icon name="close-outline" aria-hidden="true" class="close-icon"></ion-icon>
      </button>

    </div>
  </header>
</body>
</html>
