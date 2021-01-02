<link rel="stylesheet" href="css/main1.css" type="text/css">
<!-- Styleregels die alleen hier tellen -->
<style>
    body {
        width: 300px;
        margin: auto;
        padding: 100px;
    }
</style>
<?php
    session_start();
    if(isset($_POST['login'])) {
        include("../connection.php");
        
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        
        $username = $conn->real_escape_string($username);
        $password= $conn->real_escape_string($password);
                
        $sql = "SELECT id, username, password, apps, nickname FROM userinfo WHERE loginname = '$username' AND password = '$password'";
        
        $result = $conn->query($sql);
        
        if($result->num_rows == 1) {
            echo("Gebruikersnaam en wachtwoord correct!<br>");
            while($row = $result->fetch_object()) {
                $_SESSION['id'] = $row->id;
                $_SESSION['username'] = $row->username;
                $_SESSION['nickname'] = $row->nickname;
                $_SESSION['login19'] = true;
                
                $vandaag = date('l j F H:i');
                
                //laatst online bijwerken
                $sql = "UPDATE `userinfo` SET `last_login` = '$vandaag' WHERE `userinfo`.`id` = $row->id;";
        
                $result = $conn->query($sql);
                
                // Naar dgaw
                header('Location: index.php');
            }
        } else {
//            header('location: index.php');
            ?>
                <p>Verkeerde inloggegevens!<br><a href="inloggen.php">Probeer opniew</a></p>
            <?php
        }
    }
?>