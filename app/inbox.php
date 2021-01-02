<html>
    <head>
        <link rel="manifest" href="manifest.json">
        <link rel="stylesheet" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?php
            include "head.php";
        ?>
    </head>
    <body>
        <div class="head-section w3-red w3-bar w3-wide w3-padding">
            <p>BERICHTEN</p>
        </div>
        <div class="content w3-margin-left w3-margin-right">
            <?php
                include "../connection.php";
            
                if($_SESSION['login19'] == true) {
                    // Inboxz
                    echo "<h2>Inbox</h2>";
                    $id = $_SESSION["id"]; 
                    $sql = "SELECT * FROM private_messages WHERE to_id = '$id' ORDER BY `private_messages`.`id` DESC";

                    $inbox = $conn->query($sql);
                    if(!$inbox->num_rows == 0) {
                        while($row = $inbox->fetch_object()) {
                            ?>
                            <div class="postbericht w3-margin-top" onclick="window.location = 'message.php?id=<?php echo $row->id; ?>'" tappable>
                                <h4><b><?php echo $row->subject; ?></b> <span style="display:block;font-size:14px;">[<i><?php echo $row->time_sent; ?></i>]</span></h4>
                            </div>
                            <hr>
                            <?php
                        }
                    } else {
                        echo "<p>Je hebt nog geen berichten ontvangen.</p>";
                    }

                    //Verstuurtd
                    echo "<h2>Verstuurd<h2>";
                    $sql = "SELECT * FROM private_messages WHERE from_id = '$id' ORDER BY `private_messages`.`id` DESC";
                    $sent = $conn->query($sql);
                    if(!$sent->num_rows == 0) {
                        while($row = $sent->fetch_object()) {
                            ?>
                            <div class="postbericht w3-margin-top" onclick="window.location = 'message.php?id=<?php echo $row->id; ?>'" tappable>
                                <h4><b><?php echo $row->subject; ?></b> <span style="display:block;font-size:14px;">[<i><?php echo $row->time_sent; ?></i>]</span></h4>
                            </div>
                            <hr>
                            <?php
                        }
                    } else {
                        echo "<p>Je hebt nog geen berichten verstuurd</p>";
                    }
                } else {
                    echo "Je moet ingelogd zijn om dit te bekijken. <a href='inloggen.php'>Inloggen</a>";
                }
              
            ?>
        </div>
        <div class="navigation">
            <?php
                include "nav.php";
            ?>
        </div>
    </body>
</html>