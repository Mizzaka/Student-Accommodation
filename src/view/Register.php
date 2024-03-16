<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <style>
        body {
            background:url(images/login_background.JPG);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signin-content {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            margin-top: -5px;
            animation: slideIn 0.5s ease forwards;
        }
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .signin-image {
            text-align: center;
            margin-bottom: 30px;
        }
        .signin-image img {
            max-width: 100%;
            height: auto;
        }
        .signup-image-link {
            color: #05a812;
            font-weight: bold;
            text-decoration: none;
        }
        .signin-form {
            text-align: center;
        }
        .form-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            margin-top: -20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input, .form-group select {
            width: 90%;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #3cb815;
        }
        .agree-term {
            margin-right: 5px;
        }
        .form-button {
            margin-top: 20px;
        }
        .form-submit, .form-register {
            background-color: #3cb815;
            color: #fff;
            border: none;
            padding: 15px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .form-submit:hover, .form-register:hover {
            background-color: #1e8900;
        }
        .social-login {
            margin-top: 20px;
        }
        .social-label {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }
        .socials {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        .socials li {
            margin: 0 10px;
        }
        .socials li a {
            font-size: 24px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Sign in Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    
                    
                </div>
                <div class="signin-form">
                    <h2 class="form-title">Register</h2>
                    <form action="../controller/registerController.php" method="post" class="register-form" id="register-form">
                        <div class="form-group">
                            <input type="text" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" name="contact" id="contact" placeholder="Your Contact"/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="conpassword" id="conpassword" placeholder="Confirm Password"/>
                        </div>
                        <div class="form-group">
                          <select name="acctype" id="acctype">
                              <option value="">Choose Account Type</option>
                              <option value="student">Student</option>
                              <option value="landlord">Landlord</option>
                              <option value="warden">Warden</option>
                          </select>
                      </div>
                        <div class="form-group form-button">
                            <input type="submit" name="register" id="register" class="form-submit" value="Register"/>
                        </div>
                    </form>
                    <a href="login.php" class="signup-image-link">Already have an account? Log in</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
