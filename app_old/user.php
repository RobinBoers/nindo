<link rel="manifest" href="manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Onsen UI -->
<link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
<link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
<script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>

<?php
    include "head.php";
?>
<ons-page>
<?php
    $niks = true;
    if(isset($_GET['id'])) {
        include("../connection.php");
        
        $id = strip_tags($_GET['id']);        
        $id = $conn->real_escape_string($id);
               
        //echo($id);
        
        $sql = "SELECT * FROM userinfo WHERE id = '$id'";
        
        $result = $conn->query($sql);
        
        if($result->num_rows == 1) {
            while($row = $result->fetch_object()) {
                $username = $row->username;
                $nickname = $row->nickname;
                $user_id = $row->id;
                $beschrijving = $row->beschrijving;
                $last_online = $row->last_login;
                ?>
                <ons-toolbar>
                    <ons-back-button onclick="window.location = 'index.php'">Terug</ons-back-button>
                    <div class="center">
                        <?php
                        echo($username); ?> ~~ 
                        <?php echo($nickname);
                         ?>
                    </div>
                </ons-toolbar>
                <br><a href="messages/messageform.php?id=<?php echo($user_id); ?>">Berichtje sturen!</a>
                <br><a href="messages/contactform.php?id=<?php echo($user_id); ?>">Als vriend toevoegen!</a>
                <p style="clear:left;padding-top:10px;">Laatst online: <?php echo($last_online); ?></p>
                <h3>Beschrijving</h3>
                <p><?php echo $beschrijving; ?></p>
                <h3>Berichten</h3>
                <div class="post">
                <?php
                if(file_exists("posts.json") && filesize("posts.json") > 0){
                    $handle = fopen("posts.json", "a+");
                    $contents = fread($handle, filesize("posts.json"));
                    $posts = json_decode($contents);
                    fclose($handle);

                    foreach($posts as $post){
                        
                        $sql = "SELECT * FROM userinfo WHERE nickname = '$post->auteur'";
                        $result = $conn->query($sql);

                        if($result->num_rows == 1) {
                            while($row = $result->fetch_object()) {
                                $id = $row->id;
                            }
                        }
                        if(!isset($_GET['id']) || strpos($id, $_GET['id']) !== false){
                            ?>
                            <div class="bericht">
                                <h2><a href="user.php?id=<?php echo $id; ?>"><?= $post->auteur ?></a><span style="font-weight:100;font-size:16px;display:block;"><time><?= $post->datum ?></time> - <?= $post->stemming ?></span></h2>
                                <p class="clearfix"></p>
                                <p class="clearfix blogtext"><?= $post->text ?></p>
                            </div>
                            <?php
                        }    
//                        else if($niks == true) {
//                            echo("Hier is niks te vinden");
//                            $niks = false;
//                        }
                    }
                ?>    
                </div> <?php
            }
        } 
    }
    else {
//            header('location: index.php');
        ?>
            <p>Deze gebruiker bestaat niet!<br></p>
        <?php
    }
    }
?>