<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $conn=mysqli_connect('localhost','root','abcd','project');
    if (!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }

    session_start();

    $email=$_POST['email'];
    $password=$_POST['password'];

    $_SESSION['login_user']=$email;

    $sql = mysqli_query($conn,"SELECT email FROM user WHERE email='$email' and password='$password'");

    if (mysqli_num_rows($sql) != 0) {
        echo "<script language='javascript' type='text/javascript'> location.href='feed/feed/feed.php' </script>";  
    } 
    else {
        echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
    }  

?>
