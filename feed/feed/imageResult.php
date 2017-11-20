<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $connect = mysqli_connect("localhost", "root", "abcd", "project");  
	session_start();
	$curr_user = $_SESSION['login_user'];
	$imgOpened = $_GET['id'];
	$id = $imgOpened;
	//echo $imgOpened;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Image Result</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="shortcut icon" href="/var/www/html/ADPProj/assets/ico/favicon.png">

	<!-- Google Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Pacifico|Playfair+Display|Quicksand" rel="stylesheet">
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Salvattore -->
	<link rel="stylesheet" href="css/salvattore.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style2.css">
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	
	<meta name="viewport" content="width = device-width,initial-scale=1">
	<!--<link rel="stylesheet" type="text/css" href="style_web.css">-->
	<link rel="shortcut icon" href="/var/www/html/ADPProj/assets/ico/favicon.png">
	
</head>
<body>
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
	                    <div class="form-group">
	                    	<input type="text" name="searchedTag" class="form-control" placeholder="Search" style="color: white">
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

    <div class="container">
    	<div class="row" style="margin-top: 10vw">
    		<div class="col-xs-6 col-xs-offset-3">

    			<?php
    			if (isset($_POST['liked'])){
					$q8 = "SELECT * from piclike where picID='$imgOpened' and userID='$curr_user'";
					if ($likeTemp = mysqli_query($connect,$q8)){
						$rowNum_like = mysqli_num_rows($likeTemp);
						if($rowNum_like == 0){
							//case of like
							$q9 = "INSERT into piclike(picID, userID) VALUES('$imgOpened', '$curr_user')";
							if(mysqli_query($connect, $q9)){  
						        echo '<script>alert(appended to piclike)</script>';  
						    }
						    $q10 = "UPDATE images set likes=likes+1 where id='$imgOpened'";
						    if(mysqli_query($connect, $q10)){
						  		echo "<script>alert(Like incremented)<script>";
						  	}
						  	$q18 = "SELECT xp from user where id='$curr_user'";
						  	if ($extractXP = mysqli_query($connect,$q18)){
								$row_xp = mysqli_fetch_row($extractXP);
								$xp_user = $row_xp[0];
							}
							$q19 = "UPDATE images set score=score+($xp_user/10) where id='$imgOpened'";
						    if(mysqli_query($connect, $q19)){
						  		echo "score incremented";
						  	}
						  	$q20 = "SELECT userid from images where id='$imgOpened'";
						  	if ($extractXP = mysqli_query($connect,$q20)){
								$row_user = mysqli_fetch_row($extractXP);
								$photographerid = $row_user[0];
							}
							$q21 = "UPDATE user set xp = xp + ($xp/80) where id='$photographerid'";
							if(mysqli_query($connect, $q21)){
						  		echo '';
						  	}
						}
						else if($rowNum_like>0){
							$q11 = "DELETE from likes where imageid='$imgOpened' and userid='$curr_user'";
							if(mysqli_query($connect, $q11)){  
						        echo '<script>alert(deleted from likes table)</script>';  
						    }
						    $q12 = "UPDATE images set likes=likes-1 where id='$imgOpened'";
						    if(mysqli_query($connect, $q12)){
						  		echo "<script>alert(Like decremented)</script>";
						  	}
						}
					}
					header('Location: imageResult.php?id='.$id.'');
	  				exit;  
				}
    				/*if (isset($_POST['liked'])){
					$q8 = "SELECT * from likes where imageid='$imgOpened' and userid='$curr_user'";
					if ($likeTemp = mysqli_query($connect,$q8)){
						$rowNum_like = mysqli_num_rows($likeTemp);
						if($rowNum_like == 0){
							$q9 = "INSERT into likes VALUES('$imgOpened', '$curr_user')";
							if(mysqli_query($connect, $q9)){  
						        echo '<script>alert(appended to likes table)</script>';  
						    }
						    $q10 = "UPDATE images set likes=likes+1 where id='$imgOpened'";
						    if(mysqli_query($connect, $q10)){
						  		echo "<script>alert(Like incremented)<script>";
						  	}
						}
						else if($rowNum_like>0){
							$q11 = "DELETE from likes where imageid='$imgOpened' and userid='$curr_user'";
							if(mysqli_query($connect, $q11)){  
						        echo '<script>alert(deleted from likes table)</script>';  
						    }
						    $q12 = "UPDATE images set likes=likes-1 where id='$imgOpened'";
						    if(mysqli_query($connect, $q12)){
						  		echo "<script>alert(Like decremented)</script>";
						  	}
						}
					}
					header('Location: imageResult.php?id='.$id.'');
	  				exit;  
				}*/
    			?>
    			<?php
    				error_reporting(E_ALL);
    				ini_set('display_errors', 1);
    				$q1 = "SELECT * from images where id='$imgOpened'";
    				if ($clickedImg = mysqli_query($connect,$q1)){
						$row_img = mysqli_fetch_row($clickedImg);
						$theImg = $row_img[1];
						$theTime = $row_img[2];
						$theUser = $row_img[3];
						$theTags = $row_img[4];
						$theLikes = $row_img[5];
					}
					$q2 = "SELECT * from user where id='$theUser'";
                	if ($user_clickedImg = mysqli_query($connect,$q2)){
						  $row_user = mysqli_fetch_row($user_clickedImg);
				    	  $uemail = $row_user[3];
				    }

				    if(isset($_POST["comment"])){
				    	$text_comment = $_POST['comment'];
				    	$q14 = "INSERT into comments(picid,userid,comment) values('$imgOpened', '$theUser','$text_comment')";
				    	if(mysqli_query($connect, $q14)){  
					        echo '';  
					    }
					    header('Location: imageResult.php?id='.$id.'');
	  					exit; 
				    }

				    echo"<div style=\"margin-bottom:4vw; padding:1vw; box-shadow: 2px 2px 5px #888888;\">";	
					echo "<div class=\"img-frame-cap\">"."<span style=\"color:black; font-weight:bold\"><a href=\"profile.php?profile=".$uemail."\">".$uemail.'</a></span>';
                	echo "<span style=\"float:right;\">".$theTime.'</span>';
                	echo '<img src="data:image/jpeg;base64,'.base64_encode($theImg ).'" width="100%" class="img-thumnail" />';
                	echo "<div style=\"text-align:center;\">".$theTags.'</div>';
                	echo'<form method="post"><button class="btn-link btn-xs" type="submit" name="liked"><i class="fa fa-camera-retro" style="font-size:24px"></i></button></form>'.$theLikes.'   Pixl';
                	//echo '<div style="width:100%">Comment come here</div>';
                	$q15 = "SELECT * from comments order by commentTime desc";
                	$result = mysqli_query($connect, $q15);

                	while($rowdash = mysqli_fetch_array($result)){
				    	$uid_comment = $rowdash[1];
				    	$commented = $rowdash[2];
				    	$time_ofComment = $rowdash[3];

				    	$q31 = "SELECT email from user where id='$theUser'";
				    	if ($usercom = mysqli_query($connect,$q31)){
						  $row_user = mysqli_fetch_row($usercom);
						  $tata = $row_user[0];
						}  

				    	echo '<div style="width:100%"> <a href="profile.php?profile='.$tata.'">'.$tata.'</a> |   '.$commented.'</div>';
                	}
                	echo '<form method="post"><input style="background:transparent" class="w3-input" type="text" name="comment" placeholder="Write a Comment"></form>';
      				echo '</div></div>';
    			?>
    		</div>
    	</div>
    </div>
</body>

</html>