<html>
    <head>
        <link rel="manifest" href="manifest.json">
        <link rel="stylesheet" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script
          src="https://code.jquery.com/jquery-3.4.1.js"
          integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
          crossorigin="anonymous"></script>
        <?php
            include "head.php";
        ?>
    </head>
    <body>
        <script>
            scrollingElement = (document.scrollingElement || document.body)
            function scrollToBottom () {
               scrollingElement.scrollTop = scrollingElement.scrollHeight;
            }

            function scrollToTop (id) {
               scrollingElement.scrollTop = 0;
            }

            //Require jQuery
            function scrollSmoothToBottom (id) {
               $(scrollingElement).animate({
                  scrollTop: document.body.scrollHeight
               }, 500);
            }

            //Require jQuery
            function scrollSmoothToTop (id) {
               $(scrollingElement).animate({
                  scrollTop: 0
               }, 500);
            }
        </script>
        <div class="head-section w3-red w3-bar w3-wide w3-padding">
            <?php if(!isset($_GET['id'])) { ?>
            <p id="user">CHAT</p>
            <?php } else { ?>
            <a class="w3-left w3-padding" href="chat.php">&larr;</a><p class="w3-right" id="user"></p>
            <?php } ?>
        </div>
        <div class="content">
            <?php
            include "../connection.php";
            if($_SESSION['login19'] == true) { 
                
                if(isset($_GET['id'])) {
                    $account_id = $_SESSION["id"]; 
                    $to_id = $_GET["id"]; 
                    $_SESSION['contact_id'] = $_GET["id"]; 

                    $sql1 = "SELECT * FROM userinfo WHERE id = '$to_id'";
                    $finduser = $conn->query($sql1);

                    if($finduser->num_rows == 1) {
                        while($row = $finduser->fetch_object()) {
                            ?>
                            <script>
                                document.getElementById('user').innerHTML = "<?php echo $row->username; ?>";
                            </script>
                            <?php
                        }
                    }

                ?>
            <div id="postBox33">

            </div>
            <script>
                loadMessenger();
                setInterval(loadMessenger, 1000);
                function loadMessenger() {	
                    $.ajax({
                        url: "../loadmessenger.php",
                        cache: false,
                        success: function(html){		
                            $("#postBox33").html(html); 
                            console.log("load messenger");
                        },
                    });
                }
                setTimeout(scrollDown, 200);
                function scrollDown() {
                    var scrollingElement = (document.scrollingElement || document.body);
                    scrollingElement.scrollTop = scrollingElement.scrollHeight;
                }
            </script>
            <div style="background-color:#c2c2d6;left:0;" class="w3-bar w3-bottom w3-padding">
                <input id="messageText222" style="width:70%!important;" class="w3-bar-item w3-input w3-border w3-round-large" type="text" value="">
                <input id="messageToId" name="to_id" value="<?php echo $to_id; ?>" type="text" style="display:none!important;">
                <input id="messageFromId" name="from_id" value="<?php echo $_SESSION['id']; ?>" type="text" style="display:none!important;">
                <input id="messageFromName" name="from_name" value="<?php echo $_SESSION['username']; ?>" type="text" style="display:none!important;">
                <button id="messageBtn" style="width:20%!important;" class="w3-right w3-hover-indigo w3-red w3-bar-item w3-button w3-round-large w3-center" type="button"><i class="fa fa-paper-plane"></i></button>
            </div>

            <script>
                
            var input = document.getElementById("messageText222");
            input.addEventListener("keyup", function(event) {
              if (event.keyCode === 13) {
               event.preventDefault();
               document.getElementById("messageBtn").click();
              }
            });    
                
            $("#messageBtn").click(function(){
                var postText = $("#messageText222").val();
                var postToId = $("#messageToId").val();
                var postFromId = $("#messageFromId").val();
                var postFromName = $("#messageFromName").val();
                $.post("../postmessage.php", {text: postText, to_id: postToId, from_id: postFromId, from_name: postFromName});
                console.log("konijn");
                document.getElementById("messageText222").value = "";
                console.log("konijn 1");
                scrollSmoothToBottom()
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
                            <div class="w3-container w3-margin w3-padding w3-white w3-round w3-margin-bottom">
                                <div onclick="window.location = '?id=<?php echo $row->account_id; ?>'">
                                    <?php echo $row->name; ?>                               
                                </div>
                            </div>
                            <hr>
                            <?php
                        }
                    }
                      
                }
            } else {
                echo "<p class='w3-margin'>Je moet ingelogd zijn om dit te bekijken. <a href='inloggen.php'>Inloggen</a></p>";
            } ?>
        </div>
        <div class="navigation">
            <?php
                if(!isset($_GET['id'])) { 
                    include "nav.php";
                } else { ?>
                <!-- Insert bar to send message -->
                <?php } 
            ?>
        </div>
    </body>
</html>