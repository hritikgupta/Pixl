<?php 
    
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

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
  
?>

