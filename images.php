<!DOCTYPE html>
<html>
    <head>
        <title>Nindo Images</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        button, input, textarea {
            outline: none;
        }
        #inbox19 a, #sent19 a, #friends19 a {
            text-decoration: none;
        }
        </style>
    </head>
    <body class="w3-theme-l5">

        <?php
            include "includable/nindo_header.php";
            if($_SESSION['login19'] == true) { 
                include "connection.php";
                ?>

                <div class="w3-container w3-margin w3-card w3-round w3-white w3-padding">
                    <a style="text-decoration:none;" href="index.php">&larr; Terug</a>
                    <h2><b>Nindo</b> Images</h2>
                    <p>In Nindo Images kun je foto's uploaden, zodat je die kunt gebruiken in je posts op Nindo.<br>Als je nog geen foto's in je Galerij hebt staan, kun je die hieronder toevoegen.</p>
                    <h3>Foto's Toevoegen</h3>
                    <form method='post' action='' enctype='multipart/form-data'>
                        <input type='file' name='imagefile' >
                        <input type='submit' value='Upload' name='upload'> 
                    </form>
                    <h3>Jouw Galerij</h3>
                    <p>Klik op een foto om hem toe te voegen aan een post, een profielfoto instellen doe je <a href="/account/setprofile.php">hier</a>.</p>
                    <?php
                        if($_SESSION['login19'] == true) {
                            $account_id = $_SESSION["id"]; 
                            $sql = "SELECT * FROM images WHERE in_account_id = '$account_id'";
                            $findimage = $conn->query($sql);
                            if(!$findimage->num_rows == 0) {
                                while($row = $findimage->fetch_object()) {
                                    $url = $row->url;
                                    ?>
                                    <a href="index.php?img=<?php echo $url; ?>"><img class="w3-third" src="<?php echo $url; ?>"></a>
                                    <?php
                                }
                            } else {
                                echo "<p>Je hebt nog geen foto's</p>";
                            }
                        }
                    ?>
                </div>
                <?php
                // Compress image
                function compressImage($source, $destination, $quality) {

                  $info = getimagesize($source);

                  if ($info['mime'] == 'image/jpeg') {
                    $image = imagecreatefromjpeg($source);
                  }
                  elseif ($info['mime'] == 'image/gif') {
                    $image = imagecreatefromgif($source);
                  }
                  elseif ($info['mime'] == 'image/png') {
                    $image = imagecreatefrompng($source);
                  }
                  if (imagejpeg($image, $destination, $quality)) {
                    $code = "/$destination";
                    echo "De code is: $code";
                      
                    $id = $_SESSION['id'];
                      
                    include "connection.php";
                    $newimage = "INSERT INTO images (id, url, in_account_id) VALUES (NULL, '$code', '$id')";
                    $enter = $conn->query($newimage);
                      
                    header("Location: images.php");
                      
                  }
                }
                
                if(isset($_POST['upload'])){

                  // Getting file name
                  $filenameId = uniqid();
                  $filename = $_FILES['imagefile']['name'];

                  // Valid extension
//                  $valid_ext = array('png','PNG','jpeg','JPEG','jpg','JPG');
                  $valid_ext = array('png','jpeg','jpg');

                  // Location
                  $location = "nindo_images/".$filename;
                  $locationId = "nindo_images/".$filenameId.".jpg";

                  // file extension
                  $file_extension = pathinfo($location, PATHINFO_EXTENSION);
                  $file_extension = strtolower($file_extension);

                  // Check extension
                  if(in_array($file_extension,$valid_ext)){

                    // Compress Image
                    compressImage($_FILES['imagefile']['tmp_name'],$locationId,60);

                  }else{
                    echo "Invalid file type.";
                  }
                }

            } else {
                header("Location: index.php");
            }
        ?>
    </body>
</html>