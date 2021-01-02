<!DOCTYPE html>
<html>
    <head>
        <title>
            Mijn account - geheimesite.nl
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
                if(isset($_POST['beschrijving'])) {
                    $beschrijving = strip_tags($_POST['beschrijving']);
                    $loginname = $_SESSION['n_name'];
                    $id = $_SESSION['id'];

                    $beschrijving= $conn->real_escape_string($beschrijving);
                    $loginname = $conn->real_escape_string($loginname);

                    $sql = "UPDATE userinfo SET beschrijving = '$beschrijving' WHERE loginname = '$loginname' AND id = '$id'";

                    $result = $conn->query($sql);

                    echo("Profielbeschrijving succesvol veranderd naar: $beschrijving!<br><a href='../account/index.php'>OK</a>");
                }
            }
        ?>
    </body>
</html>