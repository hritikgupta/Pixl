 <?php 
 //session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
 $connect = mysqli_connect("localhost", "root", "abcd", "project");  
 session_start();
 $curr_user = $_SESSION['login_user'];	  
      $qq = "SELECT * from user where email='$curr_user'";
      if ($findid=mysqli_query($connect,$qq)){
		  $row=mysqli_fetch_row($findid);
    	  $hisid=$row[0];
    	  $hisDP=$row[5]; 

/*
$input_tags; // comma/space separated words
$tag = explode(" ,", $input_tags);
for ($i=0; $i < sizeof($tag); $i++) { 
  echo $tag[i];
  // check if $tag[i] table exists in database
  // if yes{
  //   add pic id to that particular tag table
  // }
  // if no{
  //   create table with $tag[i] as table name
  //   add pic id to this parti tag table
  // }
}*/
	}
 if(isset($_POST["insert"])){

 	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
    $query = "INSERT INTO images(image,userid) VALUES ('$file','$hisid')";  
    if(mysqli_query($connect, $query)){  
        echo '<script>alert("Image Inserted into Database")</script>';  
    }

 	$tags = $_POST["tags"];
   	$myArray = explode(', ', $tags);
   	for ($i=0; $i < sizeof($myArray); $i++){
   		$qq = "SHOW TABLES LIKE '$myArray[$i]'";
   		if($checkTag = mysqli_query($connect,$qq)){
      		$rows=mysqli_num_rows($checkTag);
      
      	if($rows == 0){
	        $sql = "CREATE TABLE `".$myArray[$i]."`(
	        picid int(11),
	        FOREIGN KEY (picid) REFERENCES images(id)
	        )";
	        $q1 = "INSERT INTO alltags(tagname, tagcount) VALUES('$myArray[$i]', '1')";
	        if(mysqli_query($connect, $q1)){
	        	echo "tag added to alltags";
	        }
        	if (mysqli_query($connect, $sql)) {
            	echo "<script>alert('You added a new tag to PixlWorld!')</script>";
         	}

         	$q4 = "SELECT id from images where image='$file'";
         	if($tagged = mysqli_query($connect, $q4)){
         		$row = mysqli_fetch_row($tagged);
         		$id_taggedImg = $row[0];
         	}
         	$q5 = "INSERT into $myArray[$i] VALUES('$id_taggedImg')";
         	if(mysqli_query($connect, $q5)){
         		echo "added image id to tag(can be any name) table";
         	}   
      	}
   	}
  }
  	$q6 = "UPDATE images set tags='$tags' where userid='$hisid' and image='$file'";
  	if(mysqli_query($connect, $q6)){
  		echo "Added list of tags to image table";
  	}

	  header('Location: feed.php');
	  exit;  
 }  
 ?>  
<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pixl</title>
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
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body style="">

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
    <ul id="social_side_links">
		<li><a style="background-color: transparent;" data-toggle="modal" data-target="#exampleModalLong"" href="#"><i class="fa fa-plus-square" aria-hidden="true" style="font-size: 40px; color: #16b0ce"></i></a></li>
	</ul>

	<!-- Modal -->
	<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h2 class="modal-title" id="exampleModalLongTitle">Upload an image</h2>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form method="post" enctype="multipart/form-data">  
		         <input type="file" name="image" id="image" />  
		         <br />  
		         <input type="text" name="tags" placeholder="Give some tags..." style="width: 100%; border: 0;"><br/><br/>
		         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
		    </form>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- END .header -->
	
	<!---
    <form method="post" enctype="multipart/form-data">  
         <input type="file" name="image" id="image" />  
         <br />  
         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
    </form>  
    -->

    <div id="fh5co-main">
		<div class="container" style="margin-top: 6vw">
			<div class="row">
			<div class="col-md-3 fixed"><div class="affix">Streaming the top searched tags</div></div>
			<div class="col-xs-6">
					<div class="photocontainter	">
						<?php  
			                $query = "SELECT * FROM images ORDER BY id DESC";  
			                $result = mysqli_query($connect, $query);  
			                $count = 0;
			                while($row = mysqli_fetch_array($result)){
			                	 $count+=1;

			                	 $reqname = $row['userid'];
			                	 $qq = "SELECT * from user where id='$reqname'";
			                	 if ($find_email = mysqli_query($connect,$qq)){
									  $row_user = mysqli_fetch_row($find_email);
							    	  $his_email = $row_user[3];
							    	  $hisTags = $row_user[4];
							  		//mysqli_free_result($findid);
								}
								 echo"<div style=\"margin-bottom:4vw; box-shadow: 2px 2px 5px #888888;\">";	
								echo "<div class=\"img-frame-cap\">"."<span style=\"color:black; font-weight:bold\"><a href=\"profile.php?profile=".$his_email."\">".$his_email.'</a></span>';
			                	 echo "<span style=\"float:right;\">".$row['created'].'</span>';
			                	 echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" width="100%" class="img-thumnail" />';
			                	 echo "<div style=\"text-align:center;\">".$row['tags'].'</div>';
			                	 echo'<i class="fa fa-camera-retro" style="margin-top:0.5vw; font-size:24px"></i>  23 Pixl</div></div>';         
			                }
			                if($count == 0)
			                	echo '<span>No image to display!</span>'  
			                ?>
			      			<!--<div class="fh5co-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, eos?</div>-->
					</div>
			</div>
			<!--<div class="col-md-2">Some tes Some testn dfhdjf dfdfiuf rhfriunfr fuir Some testn dfhdjf dfdfiuf rhfriunfr fuirt</div>-->
       	 	</div>
       </div>
    </div>

	<footer id="fh5co-footer">
		
		<div class="container">
			<div class="row row-padded">
				<div class="col-md-12 text-center">
					<p class="fh5co-social-icons">
						All copyrights included. Pixl
					</p>
				</div>
			</div>
		</div>
	</footer>


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<!-- Salvattore -->
	<script src="js/salvattore.min.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script>

	<script type="text/javascript">
		 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
	</script>
	</body>
</html>
