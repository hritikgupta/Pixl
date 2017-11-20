<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $connect = mysqli_connect("localhost", "root", "abcd", "project");  
	session_start();
	$curr_user = $_SESSION['login_user'];
	$imgOpened = $_GET['toLike'];	

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
		  		echo "<script>alert('Like incremented')<script>";
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
			
?>