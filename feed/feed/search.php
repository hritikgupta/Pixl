<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $connect = mysqli_connect("localhost", "root", "abcd", "project");  
    session_start();
    $term = $_POST['searchedTag'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/var/www/html/ADPProj/assets/ico/favicon.png">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Playfair+Display|Quicksand" rel="stylesheet">
    
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Salvattore -->
    <link rel="stylesheet" href="css/salvattore.css">
    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">

    <title>Search</title>
    <link href="css2/bootstrap.min.css" rel="stylesheet">
    <link href="css2/small-business.css" rel="stylesheet">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>
</head>

<body>

<style type="text/css">
    <style type="text/css">
        .img-frame-cap {
            width:100%;
            background:#fff;
            padding:18px 18px 2px 18px;
            border:1px solid #999; }
         .navbar {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }
        body{
            font-size: 1.2vw;
        }
    </style>
</style>

<nav class="navbar navbar-inverse" role="navigation" style="background:rgba(0, 0, 0,0.8); padding-right: -4vw; position: fixed; width: 100%; z-index: 500">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand font1" style="font-size: 2.5vw; color: white; font-family: 'Pacifico', cursive;" href="feed.php">Pixl</a>
                    </div>

                    <div class="collapse navbar-collapse" id="top-navbar-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li style="margin-right: 2vw;">
                                <?php 
                                    error_reporting(E_ALL);
                                    ini_set('display_errors', 1);
                                    echo '<a href="profile.php?profile='.$_SESSION['login_user'].' ">'.$_SESSION['login_user'].'</a>';
                                ?>
                            </li>
                            <li><a class="launch-modal" data-modal-id="modal-register" href="logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

<header class="intro-header" style="background-image: url('img2/caralog8.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading" style="color: black">
                        <h1><?php echo $term?></h1>
                        <hr class="small" style="border-color: black">
                        <span class="subheading">Enticing with the passion.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php
                    $q1 = "SHOW TABLES LIKE '$term'";
                    if($checkTag = mysqli_query($connect,$q1)){
                        $row = mysqli_num_rows($checkTag);
                        if($row == 0){
                            echo '<div style="text-align:center">No image found matching the search!</div>';
                        }
                        else{
                            $row = mysqli_fetch_row($checkTag);
                            $tagName = $row[0];
                            $arr    = array();
                            $q2 = "SELECT * from $tagName";
                            $result = mysqli_query($connect, $q2);
                            while( $row = mysqli_fetch_assoc( $result )){
                                $fetchedID = $row['picid'];
                                $q3 = "SELECT * from images where id=$fetchedID";
                                if ($findImageDetails = mysqli_query($connect,$q3)){
                                      $row_img = mysqli_fetch_row($findImageDetails);
                                      $theImage = $row_img[1];
                                      $userID = $row_img[3];
                                      $time = $row_img[2];
                                    //mysqli_free_result($findid);
                                }
                                $q4 = "SELECT * from user where id='$userID'";
                                if ($retUser = mysqli_query($connect,$q4)){
                                      $row_user = mysqli_fetch_row($retUser);
                                      $user_email = $row_user[3];
                                }
                                
                                echo"<div style=\"margin-bottom:4vw; padding:1vw; box-shadow: 2px 2px 5px #888888;\">";  
                                echo "<div class=\"img-frame-cap\">"."<span style=\"color:black; font-weight:bold\"><a href=\"profile.php?profile=".$user_email."\">".$user_email.'</a></span>';
                                echo "<span style=\"float:right;\">".$time.'</span>';
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($theImage).'" width="100%" class="img-thumnail" />';
                                //echo "<div style=\"text-align:center;\">".$row['tags'].'</div>';
                                //echo'<i class="fa fa-camera-retro" style="margin-top:0.5vw; font-size:24px"></i>  23 Pixl</div></div>';
                            }
                        }
                    }
                ?>

            </div>
        </div>
    </div>

   
    <!-- jQuery -->
    <script src="js2/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js2/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js2/small-business.min.js"></script>

    <!-- Smooth Scroll -->
    <script src="js2/SmoothScroll.js"></script>

</body>

</html>
