<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['submit'])){
	$check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));


        /*
         * Insert image data into database
         */
        
        //DB details
        
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = 'abcd';
        $dbName     = 'project';
        
        $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        //creation of table
        /*$tabl = "CREATE TABLE `images` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `image` longblob NOT NULL,
         `created` datetime NOT NULL,
         PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        
        if (mysqli_query($conn, $tabl)) {
            echo "Table created successfully";
        } 
        else{
            echo "Error creating: " . mysqli_error($conn);
        }*/
        
        //$dataTime = date("Y-m-d H:i:s");

        $insert = "INSERT into images (image) VALUES ('$imgContent')";
        if(mysqli_query($conn, $insert)){
            echo '<alert>File uploaded successfully.</alert>';
        }
        else{
            echo '<alert>File upload failed, please try again.</alert>';
        }
    }
    else{
        echo '<alert>Please select an image file to upload.</alert>';
    }
    mysqli_close($conn);
}
?>