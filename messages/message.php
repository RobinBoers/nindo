<!DOCTYPE html>
<html>
    <head>
        <title>Nindo</title>
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
            include "../includable/nindo_header.php";
            include "../connection.php";
        ?>
        <div class="w3-content" style="max-width:1400px;margin-top:80px">    
            <a href="../index.php">&larr; Terug</a>
            <hr>
            <?php
            if($_SESSION['login19'] == true) {
                $account_id = $_SESSION["id"]; 
                $msg_id = $_GET["id"]; 
                $sql = "SELECT * FROM private_messages WHERE id = '$msg_id'";
                $findmessage = $conn->query($sql);
                if($findmessage->num_rows == 1) {
                    while($row = $findmessage->fetch_object()) {
                        if($row->to_id == $account_id || $row->from_id == $account_id) {
                        ?>
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container">
                                <h4 class="w3-margin-top w3-center">
                                    <?php echo $row->subject; ?>
                                </h4>
                                <hr>
                                <p class="w3-margin">
                                    <a href="../user.php?id=<?php echo $row->from_id ?>">
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
                        }
                        $sql = "UPDATE `private_messages` SET `opend` = '1' WHERE `private_messages`.`id` = $msg_id;";
                        $updatemessage = $conn->query($sql);
                    }
                }
            }
            ?>
        </div>
    </body>
</html>
                      