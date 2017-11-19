<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pixl</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link href="https://fonts.googleapis.com/css?family=Pacifico|Playfair+Display|Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <style type="text/css">
            .shadower{
                text-shadow: 2px 2px #000000;
            }
            .font1{
                font-family: 'Pacifico', cursive;
            }
            .font2{
                font-family: 'Quicksand', sans-serif;
            }
            .navbar {
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 0;
            }
        </style>
        <!-- Top content -->
        <div class="top-content">
            <nav class="navbar navbar-inverse" role="navigation" style="background:rgba(0, 0, 0,0.7); padding-right: -4vw">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand font1" style="font-size: 2.5vw; color: white" href="index.html">Pixl</a>
                    </div>
                    <div class="collapse navbar-collapse" id="top-navbar-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a class="launch-modal" data-modal-id="modal-register" href="#">Sign Up</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="inner-bg">
                <div class="container" style="margin-top: -4vw">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text font2">
                            <h1 class="shadower"><strong>Login to see photos from your friends.</strong></h1>
                            <div class="description">
                                <p class="shadower font2">
                                    Dive into the fascinating world of photograhy. <br/>Share and upload your own photos and rate photos of your friends.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left font2">
                                    <h3>Connect to the world here</h3>
                                    <p>Enter your username and password to log on:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom font2">
                                <form id="myform1" role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Registered Email</label>
                                        <input type="text" name="email" placeholder="Registered Email..." class="form-username form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control">
                                    </div>
                                    <button type="submit" name="submit" class="btn">Sign in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal-->
        <div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h3 class="modal-title" id="modal-register-label">Sign up now</h3>
                        <p>Fill in the form below to get instant access:</p>
                    </div>
                    
                    <div class="modal-body">
                        <form id="myform2" role="form" action="" method="post" class="registration-form">
                            <div class="form-group">
                                <label class="sr-only" for="form-first-name">First name</label>
                                <input type="text" required name="firstname" placeholder="First name..." class="form-first-name form-control">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" required for="form-last-name">Last name</label>
                                <input type="text" name="lastname" placeholder="Last name..." class="form-last-name form-control">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" required for="form-email">Email</label>
                                <input type="text" name="email" placeholder="Email..." class="form-email form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" required for="form-password">Password</label>
                                <input type="password" name="password" placeholder="Password..." class="form-password form-control">
                            </div>
                            <button type="submit" name="submit2" class="btn">Sign me up!</button>
                        </form>                        
                    </div>
                    
                </div>
            </div>
        </div>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (isset($_POST['submit'])){     
            $db = mysqli_connect('localhost', 'root', 'abcd', 'project');
            if (!$db){
                die("Connection failed: " . mysqli_connect_error());
            }
            session_start();
            $email=$_POST['email'];
            $password=$_POST['password'];

            $_SESSION['login_user'] = $email;
            $query = mysqli_query($db,"SELECT email FROM user WHERE email='$email' and password='$password'");
            if (mysqli_num_rows($query) != 0){
              echo "<script language='javascript' type='text/javascript'> location.href='feed/feed/feed.php' </script>";   
            }
            else{
              echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
            }
          }
        ?>

        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            if (isset($_POST['submit2'])){
                 $conn=mysqli_connect('localhost','root','abcd','project');
                  if (!$conn){
                    die("Connection failed: " . mysqli_connect_error());
                  }

              $firstname=$_POST['firstname'];
              $lastname=$_POST['lastname'];
              $email=$_POST['email'];
              $password=$_POST['password'];

              $sql = "INSERT INTO user(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')";

              if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("Thanks for signing up to Pixl!")</script>';
              } 
              else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }

              mysqli_close($conn);
            }
        ?>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/script2.js"></script>        

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
