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
            include "includable/nindo_header.php";
            include "connection.php";
        ?>
            
        <div class="w3-container w3-card w3-white w3-round w3-margin w3-padding">
           <h3>Vind mensen:</h3> 
            <form method="get">
                <input name="p" required><input value="Zoeken" type="submit">
            </form>
        </div>
        <div class="w3-container">
            <?php
                if(isset($_GET["p"])) {
                    $zoektermP = $_GET["p"];
                    include("connection.php");

                    echo "<h4 class='w3-clear'>Voornamen</h4>";
                    $sql = "SELECT * FROM userinfo";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_object()) {
                        $name = $row->username;
                        $nickname = $row->nickname;
                        $id = $row->id;
                        if(preg_match("/$name/", $zoektermP) || preg_match("/$zoektermP/", $name)){
                            ?>
                            <a href="user.php?id=<?php echo $id ?>">
                                <div class="w3-container w3-margin w3-half w3-card w3-round w3-white">
                                    <div class="w3-center">
                                        <h4><?php echo $name ?></h4>
                                        <p><?php echo $nickname ?></p>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                    }

                    echo "<div class='w3-clear'>";
                    echo "<hr class='w3-clear'>";
                    echo "<h4>Nickname's</h4>";
                    echo "</div>";
                    $sql = "SELECT * FROM userinfo";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_object()) {
                        $name = $row->username;
                        $nickname = $row->nickname;
                        $id= $row->id;
                        while($row = $result->fetch_object()) {
                            $name = $row->username;
                            $nickname = $row->nickname;
                            if(preg_match("/$nickname/", $zoektermP) || preg_match("/$zoektermP/", $nickname)) { ?>
                                <a href="user.php?id=<?php echo $id ?>">
                                    <div class="w3-margin w3-container w3-half w3-card w3-round w3-white">
                                        <div class="w3-center">
                                            <h4><?php echo $name ?></h4>
                                            <p><?php echo $nickname ?></p>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>