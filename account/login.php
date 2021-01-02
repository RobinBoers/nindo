<?php
session_start();
    if(isset($_POST['login'])) {
        include("../connection.php");
        
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        
        $username = $conn->real_escape_string($username);
        $password= $conn->real_escape_string($password);
                
        $sql = "SELECT * FROM userinfo WHERE loginname = '$username' AND password = '$password'";
        
        $result = $conn->query($sql);
        
        if($result->num_rows == 1) {
            echo("Gebruikersnaam en wachtwoord correct!<br>");
            while($row = $result->fetch_object()) {
                $_SESSION['id'] = $row->id;
                $_SESSION['username'] = $row->username;
                $_SESSION['n_name'] = $row->loginname;
                $_SESSION['nickname'] = $row->nickname;
                $_SESSION['email'] = $row->eemail;
                $_SESSION['beschrijving'] = $row->beschrijving;
                $_SESSION['login19'] = true;
                
                $vandaag = date('l j F H:i');
                
                //laatst online bijwerken
                $sql = "UPDATE `userinfo` SET `last_login` = '$vandaag' WHERE `userinfo`.`id` = $row->id;";
        
                $result = $conn->query($sql);
                
                // Naar accountbeheer
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