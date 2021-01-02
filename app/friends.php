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
            <p>VRIENDEN</p>
        </div>
        <div class="content">
            <?php
                include "../connection.php";
                
                if($_SESSION['login19'] == true) {
                    $id = $_SESSION['id'];
                    $sql = "SELECT * FROM contacten WHERE in_account_id = '$id'";
                    $contacts = $conn->query($sql);
                    if(!$contacts->num_rows == 0) {
                        while($row = $contacts->fetch_object()) {
                            ?>
                            <div class="w3-container w3-margin w3-padding w3-white w3-round w3-margin-bottom">
                                <div onclick="window.location = 'user.php?id=<?php echo $row->account_id; ?>'">
                                    <?php echo $row->name; ?>
                                </div>
                            </div>
                            <hr>
                            <?php
                        }
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