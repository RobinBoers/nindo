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
            include "../php/nindo_header.php";
            if($_SESSION['login19'] == true) { 
                include "../connection.php";
                ?>

                <div class="w3-container w3-margin w3-card w3-round w3-white w3-padding">
                    <a style="text-decoration:none;" href="index.php">&larr; Terug</a>
                    <h2><b>Nindo</b> Images</h2>
                    <p>Kies een profielfoto, of upload er een. <a href="../images.php">Foto uploaden</a></p>
                    <h3>Jouw Galerij</h3>
                    <?php
                        if($_SESSION['login19'] == true) {
                            $account_id = $_SESSION["id"]; 
                            $sql = "SELECT * FROM images WHERE in_account_id = '$account_id'";
                            $findimage = $conn->query($sql);
                            if(!$findimage->num_rows == 0) {
                                while($row = $findimage->fetch_object()) {
                                    $url = $row->url;
                                    ?>
                                    <a href="/scripts/newpicture.php?picture=<?php echo $url; ?>"><img class="w3-third" src="<?php echo $url; ?>"></a>
                                    <?php
                                }
                            } else {
                                echo "<p>Je hebt nog geen foto's</p>";
                            }
                        }
                    ?>
                </div>
               <?php 
            } else {
                header("Location: index.php");
            }
        ?>
    </body>
</html>