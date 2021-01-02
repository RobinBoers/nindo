<!DOCTYPE html>
<html>
    <head>
        <title>Nindo</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<!--        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">-->
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script src="/notification.js"></script>
        <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        button, input, textarea {
            outline: none;
        }
        #inbox19 a, #sent19 a, #friends19 a {
            text-decoration: none;
        }
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, {
            text-decoration: none !important;
        }
        .post22222 img {
            max-width:100%;
        }
        @media screen and (min-width: 601px) {
          .post22222 {
            margin-left:16px;
            margin-right:16px;
          }
        }
        .modal {
          display: none; 
          position: fixed; 
          z-index: 1;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          overflow: auto; 
          background-color: rgb(0,0,0);
          background-color: rgba(0,0,0,0.4); 
          padding-top: 60px;
        }

        .modal-content {
          background-color: #fefefe;
          margin: 5% auto 15% auto; 
          border: 1px solid #888;
          width: 80%;
        }

        .close {
          position: absolute;
          right: 25px;
          top: 0;
          color: #000;
          font-size: 35px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: red;
          cursor: pointer;
        }

        .animate {
          -webkit-animation: animatezoom 0.6s;
          animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
          from {-webkit-transform: scale(0)} 
          to {-webkit-transform: scale(1)}
        }

        @keyframes animatezoom {
          from {transform: scale(0)} 
          to {transform: scale(1)}
        }

        @media screen and (max-width: 300px) {
          span.psw {
             display: block;
             float: none;
          }
          .cancelbtn {
             width: 100%;
          }
        }
        </style>
    </head>
    <body class="w3-theme-l5">

        <?php
            include "includable/nindo_header.php";
            include "connection.php";
        ?>

        <!-- Page Container -->
        <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
          <!-- The Grid -->
          <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
              <!-- Profile -->
              <?php
              if($_SESSION['login19'] == true) {
                
                $id = $_SESSION['id'];
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

              <!-- Accordion -->
              <div class="w3-card w3-round">
                <div class="w3-white">
                  <button onclick="openCard('inbox19')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-inbox fa-fw w3-margin-right"></i> Inbox</button>
                  <div id="inbox19" class="w3-hide w3-container">
                      <div id="inbox333" class="w3-row-padding">
                      </div>
                      <script>
                            $(document).ready(function(){
                                setInterval(loadInbox, 500);
                                function loadInbox(){	
                                    $.ajax({
                                        url: "messages/inbox.php",
                                        cache: false,
                                        success: function(html){		
                                            $("#inbox333").html(html); // Ververst automatisch de inbox	
                                            console.log("inbox");
                                        },
                                    });
                                }
                            });
                        </script>
                  </div>
                  <button onclick="openCard('sent19')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-paper-plane fa-fw w3-margin-right"></i> Verzonden berichten</button>
                  <div id="sent19" class="w3-hide w3-container">
                        <div class="w3-row-padding">
                        <?php
                            $id = $_SESSION["id"]; 
                            $sql = "SELECT * FROM private_messages WHERE from_id = '$id' ORDER BY `private_messages`.`id` DESC";
                            $inbox = $conn->query($sql);
                            if(!$inbox->num_rows == 0) {
                                while($row = $inbox->fetch_object()) {
                                    ?>
                                    <div class="w3-full">
                                        <a href="messages/message.php?id=<?php echo $row->id; ?>">
                                            <p>
                                                <b><?php echo $row->subject; ?></b><br>
                                                <span><i><?php echo $row->time_sent; ?></i></span>
                                            </p>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                        </div>
                  </div>
                  <button onclick="openCard('friends19')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Mijn vrienden</button>
                  <div id="friends19" class="w3-hide w3-container">
                      <div class="w3-row-padding">
                          <?php
                            $sql = "SELECT * FROM contacten WHERE in_account_id = '$id'";
                            $contacts = $conn->query($sql);
                            if(!$contacts->num_rows == 0) {
                                while($row = $contacts->fetch_object()) {
                                    ?>
                                    <div class="w3-full">
                                        <a href="user.php?id=<?php echo $row->account_id; ?>">
                                            <p>
                                                <?php echo $row->name; ?>
                                            </p>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                          ?>
                      </div>
                  </div> 
                  </div></div>
                <br>
                <?php } else { ?>
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container">
                         <p>Welkom bij Nindo. Dit is een online platform, waar je kunt chatten, en andere mensen ontmoeten. het zit gekoppeld aan een geheimesite-account, en is helemaal gratis!</p>
                    </div>
                </div><br>
                <img class="w3-card w3-hide-small w3-margin-bottom w3-round" src="../../../images/nindo/logobig.png"paddin:2px; width="100%">
                <?php } ?>
                

            <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="w3-col m7">
            <?php if($_SESSION['login19'] == true) { ?>
              <div class="w3-row-padding">
                <div class="w3-col m12">
                  <div class="w3-card w3-round w3-white">
                    <div class="w3-container w3-padding">
                      <!--<form post.php method="post">-->
                        <textarea id="postText" name="text" style="resize:none;width:100%;height:40px;" class="w3-border w3-padding"></textarea><!-- Height 40px for singel rule, Height 100px or higher for multi rule -->
                        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="w3-button w3-theme">+ Afbeelding</button>
                        <button id="postButton" type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button>
                        <!--</form>-->
                    </div>
                  </div>
                </div>
              </div><hr>
              <?php } ?>
                
              <div id="postbox44">
              </div>
              <script>
//                $(document).ready(function(){
//                    setInterval(loadPublic, 500);
//                    function loadPublic() {	
//                        $.ajax({
//                            url: "public/public.php",
//                            cache: false,
//                            success: function(html){		
//                                $("#postbox44").html(html); 
//                                console.log("load");
//                            },
//                        });
//                    }
//                });
                  
                setInterval(loadPublic, 1000);
                function loadPublic() {	
                    $.ajax({
                        url: "public/public.php",
                        cache: false,
                        success: function(html){		
                            $("#postbox44").html(html); 
                            console.log("load");
                        },
                    });
                }
            </script>

            <!-- End Middle Column -->
          </div>
              
          <div class="w3-col m2">
              
            <?php if($_SESSION['login19'] == true) { ?>
                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container w3-padding">
                        <a href="/account/index.php">Mijn account</a><br>
                        <a href="/account/uitloggen.php">Uitloggen</a><br>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container w3-padding">
                        <a href="/account/inloggen.php">Inloggen</a><br>
                        <a href="/account/aanmelden.php">Aanmelden</a><br>
                    </div>
                </div>
            <?php } ?>
            <br>
                    
             <div class="w3-card w3-round">
                <div class="w3-white">
                    <button onclick="window.location = 'chat/index.php'" class="w3-button w3-block w3-theme-l1 w3-left-align">Chatten</button>
                    <button onclick="window.location = 'people.php'" class="w3-button w3-block w3-theme-l1 w3-left-align">Vind mensen</button>
                    <button onclick="window.location = 'images.php'" class="w3-button w3-block w3-theme-l1 w3-left-align">Foto's</button>
                    <button onclick="window.location = 'messenger.php'" class="w3-button w3-block w3-theme-l1 w3-left-align">Messenger</button>
                </div>
              </div>
              <br>

              <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
                <p>ADS</p>
              </div>
              <br>

              <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
                <p><i class="fa fa-bug w3-xxlarge"></i></p>
              </div>

            <!-- End Right Column -->
            </div>

          <!-- End Grid -->
          </div>

        <!-- End Page Container -->
        </div>
        <br>

        <footer class="w3-container w3-theme-d3">
          <p>Gemaakt door Robin Boers. CSS Framework by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3schools.com</a></p>
        </footer>
        
        <div id="id01" class="modal">

          <div class="modal-content animate">
            <div class="w3-padding">
              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container w3-padding">
                <h4>Voer hieronder je Nindo Images code in:</h4>
                <input id="postImg" type="text" style="resize:none;width:100%;height:40px;" class="w3-border w3-padding"><br>
            </div>
            <div class="container w3-center w3-opacity w3-padding">
                OF
            </div>
            <div class="container w3-center w3-padding">
                <button type="button" onclick="window.location = 'images.php';" class="w3-button w3-theme">Selecteer een afbeelding uit je Nindo Images Galerij</button>
            </div>
            <div class="container w3-padding" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-theme">Cancel</button>
              <button type="button" onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-theme">OK</button>
            </div>
          </div>
        </div>
        
        <?php
        if(isset($_GET['img'])) {
            $imgUrl = $_GET['img'];
            echo("<script>$(\"#postImg\").attr(\"value\", \"$imgUrl\");</script>");
        }
        ?>
        
        <script>
        // Inbox, verzonden berichten en vrienden
        function openCard(id) {
          var x = document.getElementById(id);
          if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-theme-d1";
          } else { 
            x.className = x.className.replace("w3-show", "");
            x.previousElementSibling.className = 
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
          }
        }
            
        function addLike(id) {
            var postId = id;
            console.log("gaaf!");
            $.post("public/addlike.php", {id: postId});
        }
            
            // post script for public part of nindo
            $("#postButton").click(function(){
                var postText = $("#postText").val();
                var postImg = $("#postImg").val();
                $.post("post.php", {text: postText, image: postImg});
                $("#postText").attr("value", "");
                $("#postImg").attr("value", "");
                return false;
            });
            
            // Box voor afbeelding
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </body>
</html> 
