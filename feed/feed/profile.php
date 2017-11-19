 <?php 
 	session_start();  
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	$connect = mysqli_connect("localhost", "root", "abcd", "project");  
	

	//gets details of current logged in user
	$curr_user = $_SESSION['login_user'];	  
      $qq = "SELECT * from user where email='$curr_user'";
      if ($findid=mysqli_query($connect,$qq)){
		  $row=mysqli_fetch_row($findid);
    	  $hisid=$row[0];
    	  $currUserDP=$row[5];
  		//mysqli_free_result($findid);
	}

	//for changing profile pic
	if(isset($_POST["insert"])){
	      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
	      $query = "UPDATE user set displaypic = '$file' where email='$curr_user'";
	      if(mysqli_query($connect, $query)){  
	           echo '<script>alert("Your PixlPic successfully changed!)</script>';  
	      }
	 }  
 ?>  
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_GET["profile"]?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="shortcut icon" href="/var/www/html/ADPProj/assets/ico/favicon.png">

	<!-- Google Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
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
<style type="text/css">
		.img-frame-cap {
		    width:100%;
		    background:#fff;
		    padding:18px 18px 2px 18px;
		    border:1px solid #999; }
		.under{
			padding-bottom:0.8em;
			  background:linear-gradient(
			    to left,
			  transparent 33%, 
			    #EE7972 33%, 
			    #EE7972 66%, 
			    transparent 66%
			  )
			    bottom no-repeat;
			  background-size: 20% 3px;
		}
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

                    <form class="navbar-form navbar-center">
	                    <div class="form-group">
	                        <input type="text" class="form-control" placeholder="Search">
	                    </div>
                	</form>

                    <div class="collapse navbar-collapse" id="top-navbar-1">
                        <ul class="nav navbar-nav navbar-right">
                    		<li style="margin-right: 2vw">
                    			<?php 
		                    		error_reporting(E_ALL);
									ini_set('display_errors', 1);
									//include '/var/www/html/ADPProj/index.php';
									echo '<a href="profile.php?profile='.$_SESSION['login_user'].'">'.$_SESSION['login_user'].'</a>';
								?>
                    		</li>
                            <li><a class="launch-modal" data-modal-id="modal-register" href="logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>	

	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-xs-2 col-xs-offset-1">
				<div style="margin-top: 3vw">
					<?php
					$requestedProfileName = $_GET['profile'];
					$qq = "SELECT * from user where email='$requestedProfileName'";
					if($foundProfile = mysqli_query($connect, $qq)){
						$row = mysqli_fetch_row($foundProfile);
						$hisid = $row[0];
						$first_name = $row[1];
						$last_name = $row[2];
						$his_email = $row[3];
					}       
				?>	
					<?php
						$flag = 0;
						if($currUserDP!="NULL"){
							$flag = 1;
							echo'<img src="data:image/jpeg;base64,'.base64_encode($row[5]).'" width="100%" class="img-thumnail" style="width: 90%; border-radius: 50%; display:block; margin:auto;" />';
						}
						
					?>
				<!--	<img src="generic.jpg" alt="" style="width: 90%; border-radius: 50%; display:block; margin:auto;"> -->
					<a data-toggle="modal" data-target="#exampleModalLong"" href="#" style="color: black"><p class="text-center" id="picToggle" style="margin-top: 2vw;">Change your PixlPic</p></a>
				</div>				
			</div>
			<div class="col-xs-3 col-xs-offset-1">
				<h2><?php echo $his_email?></h4>
				<h3>
				<?php 
				  	echo $first_name." ".$last_name;
					?>
					

				</h3><br>
				<h3>XP - 620</h3>
			</div>
		</div><br><br><hr style="background-color: black">
		<div class="row text-center">
			<h3 class="under">Your Posts</h3>
		</div>
		<br>
		<div class="row text-center">
			<?php
				$query = "SELECT * FROM images where userid='$hisid' ORDER BY id DESC";  
			    $result = mysqli_query($connect, $query);  
			    $count = 0;
                while($row = mysqli_fetch_array($result)){
                	 $count+=1;
                	 echo "<div class=\"container\"><div class=\"row\"><div class=\"col-sm-6 col-sm-offset-3\">";
					 echo"<div style=\"margin-bottom:4vw; box-shadow: 2px 2px 5px #888888;\">";	
                	 echo "<span style=\"float:right;\">".$row['created'].'</span>';
                	 echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" width="100%" class="img-thumnail" />'.'</div></div></div></div></div></div>';         
                }
                if($count == 0)
                	echo '<span>No image to display!</span>'  
			?>
		</div>
	</div>

		<!--MODAL-->
		<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h2 class="modal-title" id="exampleModalLongTitle">Change your PixlPic</h2>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form method="post" enctype="multipart/form-data">  
			         <input type="file" name="image" id="image" />  
			         <br/>
			         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
			    </form>  
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
</body>

<!--For hiding profilepic changing option based on profile opened-->
<script type="text/javascript">
	var x = document.getElementById('picToggle');
	<?php
		if(!strcmp($requestedProfileName, $_SESSION['login_user'])){
			?>
			x.style.visibility = 'visible';	
		<?php
		}
		else{
			?>
				x.style.visibility = 'hidden';
			<?php
		}
	?>


        
        
</script>
</html>