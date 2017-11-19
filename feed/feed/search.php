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

                    <form class="navbar-form navbar-center" method="post" action="search.php">
                        <div class="form-group" style="margin-top: -6px">
                            <input type="text" name="searchedTag" class="form-control" placeholder="Search">
                        </div>
                    </form>

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
                                      $row_user = mysqli_fetch_row($findImageDetails);
                                      $theImage = $row_user[1];
                                    //mysqli_free_result($findid);
                                }
                                //echo"<div style=\"margin-bottom:4vw; box-shadow: 2px 2px 5px #888888;\">";  
                                //echo "<div class=\"img-frame-cap\">"."<span style=\"color:black; font-weight:bold\"><a href=\"profile.php?profile=".$his_email."\">".$his_email.'</a></span>';
                                //echo "<span style=\"float:right;\">".$row['created'].'</span>';
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

    <!-- Post Content -->
    <!--<article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                    <h2 class="section-heading">The Final Frontier</h2>

                    <p>Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures for reliable supply chains. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables.</p>

                    <blockquote>Proactively envisioned multimedia based expertise and cross-media growth strategies.</blockquote>

                    <p>Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric "outside the box" thinking. Completely pursue scalable customer service through sustainable potentialities.</p>

                    <h2 class="section-heading">Credibly innovate</h2>

                    <p>Credibly innovate granular internal or "organic" sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences. Dramatically synthesize integrated schemas with optimal networks.</p>

                    <a href="#">
                        <img class="img-responsive" src="img2/caralog9.jpg" alt="">
                    </a>
                    <span class="caption text-muted">Phosfluorescently engage worldwide methodologies with web-enabled technology</span>

                    <p>Interactively procrastinate high-payoff content without backward-compatible data. Quickly cultivate optimal processes and tactical architectures. Completely iterate covalent strategic theme areas via accurate e-markets.</p>


                    <p>Placeholder text by <a href="http://www.cipsum.com/">Corporate Ipsum</a>. Photos by <a href="https://unsplash.com/">unsplash.com</a>.</p>
                </div>
            </div>
        </div>
    </article>-->

   
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
