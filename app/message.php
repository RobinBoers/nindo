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
            <a class="w3-left w3-padding" href="inbox.php">&larr;</a><p class="w3-right" id="subject"></p>
        </div>
        <div class="content">
            <?php
                include "../connection.php";
                
                if($_SESSION['login19'] == true) {
                    $account_id = $_SESSION["id"]; 
                    $msg_id = $_GET["id"]; 
                    $sql = "SELECT * FROM private_messages WHERE id = '$msg_id'";
                    $findmessage = $conn->query($sql);
                    if($findmessage->num_rows == 1) {
                        while($row = $findmessage->fetch_object()) {
                            if($row->to_id == $account_id || $row->from_id == $account_id) {
                            ?>
                            <script>
                                document.getElementById("subject").innerHTML = "<?php echo $row->subject; ?>";
                            </script>
                            <div class="w3-card w3-round w3-white w3-margin">
                                <div class="w3-container">
                                    <h4 class="w3-margin-top w3-center">
                                        <?php echo $row->subject; ?>
                                    </h4>
                                    <hr>
                                    <p class="w3-margin">
                                        <a href="user.php?id=<?php echo $row->from_id ?>">
                                            <i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> 
                                            <?php echo $row->from_name ?>
                                        </a>
                                    </p>
                                    <p class="w3-margin">
                                        <?php echo(nl2br($row->text)) ?>
                                    </p>

                                </div>
                            </div>
                            <?php
                                if($row->to_id == $account_id) {
                                    $sql = "UPDATE `private_messages` SET `opend` = '1' WHERE `private_messages`.`id` = $msg_id;";
                                    $updatemessage = $conn->query($sql);
                                }
                            }
                        }
                    } else {
                        echo "<p class='w3-margin'>Het bericht is helaas niet gevonden.</p>"; 
                    }
                } else {
                    echo "<p class='w3-margin'>Je moet ingelogd zijn om dit te bekijken. <a href='inloggen.php'>Inloggen</a></p>";
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