<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Berichtinformatie</title>
        <link rel="manifest" href="manifest.json">
        <link rel="shortcut icon" href="/logo2.png" type="image/png" />
    
        <!-- Onsen UI -->
        <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
        <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
        <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
            <?php
                include "head.php";
            ?>
    </head>
    <body>
        <?php
        session_start();
        include "../../connection.php";

        if($_SESSION['login19'] == true) {
        $account_id = $_SESSION["id"]; 
        $msg_id = $_GET["id"]; 
        $sql = "SELECT * FROM private_messages WHERE id = '$msg_id'";
        $findmessage = $conn->query($sql);
        if($findmessage->num_rows == 1) { ?>
         <ons-page><?php
             while($row = $findmessage->fetch_object()) {
                    if($row->to_id == $account_id || $row->from_id == $account_id) {
                    ?>
                    <ons-toolbar>
                        <ons-back-button onclick="window.location = '../index.php'">Terug</ons-back-button>
                        <div class="center"><?php echo $row->subject; ?></div>
                    </ons-toolbar>
                    <p>Van: <a href="../user.php?id=<?php echo $row->from_id ?>"><?php echo $row->from_name ?></a></p>
                    <p><?php echo(nl2br($row->text)) ?></p>
                <?php
                }
                $sql = "UPDATE `private_messages` SET `opend` = '1' WHERE `private_messages`.`id` = $msg_id;";
                $updatemessage = $conn->query($sql);
                }
         ?></ons-page><?php
        } else {?><p>Geen bericht beschikbaar</p><ons-back-button onclick="window.location = '../index.php'">Terug</ons-back-button><?php }?>
    </body>
</html> <?php
//Account en datum bekijken
$id = $_SESSION["id"];
$vandaag = date('l j F H:i');

// Laats online bijwerken
$sql = "UPDATE `userinfo` SET `last_login` = '$vandaag' WHERE `userinfo`.`id` = $id;";
$result = $conn->query($sql);
}
?><?php
        include "head.php";
    ?>