<!DOCTYPE html>
<html>
    <head>
        <title>Nindo Messenger</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        button, input, textarea {
            outline: none;
        }
        #inbox19 a, #sent19 a, #friends19 a {
            text-decoration: none;
        }
        td {
            vertical-align: top;
        }
        </style>
    </head>
    <body class="w3-theme-l5">

        <?php
            include "includable/nindo_header.php";
            include "connection.php";
        ?>
        <div class="w3-content" style="max-width:1400px;margin-top:20px;margin-bottom:350px;">    
            <div class="w3-container w3-margin">
                <a class="w3-right" href="index.php">&larr; Terug</a>
                <h2><b>Nindo</b> Messenger</h2>
                <hr>
            <?php
            if($_SESSION['login19'] == true) { 
                
                if(isset($_GET['id'])) {
                    $account_id = $_SESSION["id"]; 
                    $to_id = $_GET["id"]; 
                    $_SESSION['contact_id'] = $_GET["id"]; 

                    $sql1 = "SELECT * FROM userinfo WHERE id = '$to_id'";
                    $finduser = $conn->query($sql1);

                    if($finduser->num_rows == 1) {
                        while($row = $finduser->fetch_object()) {
                            $profile23 = $row2->profile;
                            if($profile23 == "") {
                                $profile23 = "/images/nindo/profiel.png";
                            }
                            ?>
                            <img src="<?php echo $profile23; ?>" class="w3-margin w3-left w3-circle" style="height:60px;width:60px" alt="Profielfoto"><h3 style="-ms-transform: translateY(60%);
  transform: translateY(60%);"><?php echo $row->username; ?></h3>
                            <p style="clear:both;"></p>
                            <?php
                        }
                    }

                ?>
            </div>
            <div id="postBox33">

            </div>
            <script>
                loadMessenger();
                setInterval(loadMessenger, 1000);
                function loadMessenger() {	
                    $.ajax({
                        url: "loadmessenger.php",
                        cache: false,
                        success: function(html){		
                            $("#postBox33").html(html); 
                            console.log("load messenger");
                        },
                    });
                }
            </script>
            <div style="background-color:#c2c2d6;left:0;" class="w3-bar w3-bottom w3-padding">
                <input id="messageText" style="width:90%!important;" class="w3-bar-item w3-input w3-border w3-round-large" type="text">
                <input id="messageToId" name="to_id" value="<?php echo $to_id; ?>" type="text" style="display:none!important;">
                <input id="messageFromId" name="from_id" value="<?php echo $_SESSION['id']; ?>" type="text" style="display:none!important;">
                <input id="messageFromName" name="from_name" value="<?php echo $_SESSION['username']; ?>" type="text" style="display:none!important;">
                <button id="messageBtn" style="width:8%!important;" class="w3-right w3-hover-indigo w3-theme-l1 w3-bar-item w3-button w3-round-large" type="button"><i class="fa fa-paper-plane"></i></button>
            </div>

            <script>
               $("#messageBtn").click(function(){
                    var postText = $("#messageText").val();
                    var postToId = $("#messageToId").val();
                    var postFromId = $("#messageFromId").val();
                    var postFromName = $("#messageFromName").val();
                    $.post("postmessage.php", {text: postText, to_id: postToId, from_id: postFromId, from_name: postFromName});
                    $("#messageText").attr("value", "");
                    return false;
                }); 
            </script>
        <?php
                } else {
                    // Show contacts
                    $id22 = $_SESSION['id'];
                    $sql = "SELECT * FROM contacten WHERE in_account_id = '$id22'";
                    $contacts = $conn->query($sql);
                    if(!$contacts->num_rows == 0) {
                        while($row = $contacts->fetch_object()) {
                            ?>
                            <div class="w3-full">
                                <a href="messenger.php?id=<?php echo $row->account_id; ?>">
                                    <?php
                                        $sql = "SELECT * FROM userinfo WHERE id = '$row->account_id'";
                                        $findprofile = $conn->query($sql);
                                        if(!$findprofile->num_rows == 0) {
                                            while($row2 = $findprofile->fetch_object()) {
                                                $profile22 = $row2->profile;
                                                if($profile22 == "") {
                                                    $profile22 = "/images/nindo/profiel.png";
                                                }
                                                ?>
                                                    <img src="<?php echo $profile22; ?>" class="w3-margin w3-left w3-circle" style="height:60px;width:60px" alt="Profielfoto">
                                                <?php
                                            }
                                        }
                                    ?>
                                    <p style="-ms-transform: translateY(130%);transform: translateY(130%);">
                                        <?php echo $row->name; ?>
                                    </p>
                                    <p style="clear:both"></p>
                                </a>
                            </div>
                            <?php
                        }
                    }
                      
                }
            } else {
                header("Location: index.php");
            }
        ?>
        </div>
    </body>
</html>
                      