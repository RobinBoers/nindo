<!DOCTYPE html>
<html>
    <head>
        <title>
            Nindo Images
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="../css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
            include "../includable/nindo_header.php";
            include("../connection.php");

            if($_SESSION['login19'] == true) {
                if(isset($_GET['picture'])) {
                    $picture = $_GET['picture'];
                    $id = $_SESSION['id'];

                    $picture= $conn->real_escape_string($picture);

                    $sql = "UPDATE userinfo SET profile='$picture' WHERE id = '$id'";

                    $result = $conn->query($sql);

                    echo("Je profielfoto is aangepast, naar de foto hieronder!<br><img class='w3-third' src='$picture'><br><a href='../account/index.php'>OK</a>");
                }
            }
        ?>
    </body>
</html>