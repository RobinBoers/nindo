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
            <a class="w3-left w3-padding" onclick="window.history.back();">&larr;</a><p class="w3-right" id="user"></p>
        </div>
        <div class="content">
            <?php
                include "../connection.php";
                $niks = true;
                if(isset($_GET['id'])) {

                    $id = strip_tags($_GET['id']);        
                    $id = $conn->real_escape_string($id);

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
                            <script>
                                document.getElementById("user").innerHTML = "<?php echo $username ?>";
                            </script>
                            <div class="w3-margin">
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
                                    <div>
                                        <div onclick="window.location='newmessage.php?id=<?php echo($user_id); ?>'" class="w3-green w3-button w3-half">
                                            Bericht sturen
                                        </div>
                                        <div onclick="window.location='newfriend.php?id=<?php echo($user_id); ?>'" class="w3-blue w3-button w3-half">
                                            Vrienden worden
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w3-margin">

                                <h3>Berichten</h3>
                                <?php
                                    if(file_exists("../posts.json") && filesize("../posts.json") > 0){
                                        $handle = fopen("../posts.json", "a+");
                                        $contents = fread($handle, filesize("../posts.json"));
                                        $posts = json_decode($contents);
                                        fclose($handle);

                                        foreach($posts as $post){

                                            $sql = "SELECT * FROM userinfo WHERE nickname = '$post->auteur' OR username = '$post->auteur'";
                                            $result = $conn->query($sql);

                                            if($result->num_rows == 1) {
                                                while($row = $result->fetch_object()) {
                                                    $id = $row->id;
                                                }
                                            }
                                            if($id == $_GET['id']){
            //                                if(!isset($_GET['id']) || strpos($id, $_GET['id']) !== false){
                                                ?>
                                                <div class="w3-container w3-card w3-white w3-round "><br>
                                                    <img src="<?php echo $profile_picture ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px;height:60px;">
                                                    <span class="w3-right w3-opacity"><?= $post->datum ?></span>
                                                    <h4>
                                                        <a style="text-decoration:none;" href="user.php?id=<?php echo $id; ?>">
                                                            <?= $post->auteur ?>
                                                        </a>
                                                    </h4>
                                                    <hr class="w3-clear">
                                                    <p>
                                                        <?php echo(nl2br($post->text)) ?>
                                                    </p>
                                                    <p>
                                                        <?php if((!$post->image == "") || (!$post->image == null)) {
                                                            ?>
                                                            <img style="width:100%;" src="<?php echo($post->image) ?>">
                                                            <?php
                                                        } ?>
                                                    </p>
                                                    <!--                            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button> -->
                                                </div><br>
                                                <?php
                                            }    
                                        }
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    else {
                        ?>
                            <p>
                                Deze gebruiker bestaat niet!<br>
                            </p>
                        <?php
                    }
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