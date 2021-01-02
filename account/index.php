<!DOCTYPE html>
<html>
    <head>
        <title>
            Mijn account - Nindo
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="frame">
            <?php
                include "../includable/nindo_header.php";
                if($_SESSION["login19"] == true) { 
                include("../connection.php");
            ?>
            <main>
                <section class="w3-container account">
                    <h2>Mijn account</h2>
                    <p>
                        Ingelogd als: <?php echo($_SESSION['username']); ?>. Ben jij dit niet? <a href="uitloggen.php">Uitloggen</a>
                    </p>
                    <p>
                        Hallo <?php echo($_SESSION['username']); ?>. Dit is je Nindo-account. Je kunt hier je instellingen wijzigen.
                    </p>
                    <h3>Mijn Profiel</h3>
                    <?php

                        $id = $_SESSION['id'];
                            

                        //echo($id);

                        $sql = "SELECT * FROM userinfo WHERE id = '$id'";

                        $result = $conn->query($sql);

                        if($result->num_rows == 1) {
                            while($row = $result->fetch_object()) {
                                $username = $row->username;
                                $nickname = $row->nickname;
                                $user_id = $row->id;
                                $beschrijving = $row->beschrijving;
                                $email = $row->eemail;
                                $last_online = $row->last_login;
                                
                                $profile_picture = $row->profile;
                                
                                if($profile_picture == "") {
                                    $profile_picture = "/images/nindo/profiel.png";
                                }
                                
                                ?>

                                <div class="w3-card w3-round w3-white">
                                    <div style="padding:0px; padding-top: 5px;" class="w3-container">
                                    <img src="<?php echo $profile_picture ?>" class="w3-margin w3-left w3-circle" style="height:80px;width:80px" alt="Profielfoto">
                                    <br><h4 class="w3-margin-left">
                                        <?php echo($username); ?>
                                        <span style="font-size:16px;font-weight:normal;display:block;"><?php echo($nickname); ?></span>
                                    </h4>
                                    <p class="w3-clear"> </p>
                                    <hr>
                                    <p class="w3-margin">
                                        <i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> 
                                        <?php echo($email) ?>
                                    </p>
                                    <p class="w3-margin">
                                        <?php echo $beschrijving; ?>
                                    </p>
                                    <p class="w3-margin">
                                        Laatst online: <?php echo($last_online); ?>
                                    </p>
                                </div>
                                </div><br>
                                <a href="setprofile.php">Profielfoto aanpassen</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                                <p>
                                    Er is iets fout gegaan.<br>
                                </p>
                            <?php
                        }
                    ?>
                </section>
                <hr>
                <section class="w3-container">
                    <h3>Account instellingen</h3>
                    <h5>Verander wachtwoord</h5>
                    <form method="post" action="../scripts/newpass.php">
                        <input type="text" name="newpassword" placeholder="Nieuw wachtwoord"> 
                        <input type="submit" name="newpass" value="Opslaan">
                    </form>
                    <h5>Voeg beschrijving toe aan je Nindo-account</h5>
                    <form method="post" action="../scripts/newbeschr.php">
                        <textarea name="beschrijving" placeholder="Typ hier uw beschrijving..."></textarea>
                        <input type="submit" value="Opslaan">
                    </form>
                    <h5>Voeg emailadres toe voor het opvragen van uw wachtwoord</h5>
                    <form method="post" action="../scripts/newemail.php">
                        <input type="email" placeholder="Uw e-mailadres..." name="email">
                        <input type="submit" value="Opslaan">
                    </form><br>
                </section>
            </main>
            <?php } else {
                header("Location: inloggen.php");
            } ?>
        </div>
    </body>
</html>