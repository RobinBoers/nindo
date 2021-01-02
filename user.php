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
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
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
        <div class="w3-content" style="max-width:1400px;margin-top:80px">    
            <a href="index.php">&larr; Terug</a>
            <hr>
            <div class="w3-row">
                <?php
                $niks = true;
                if(isset($_GET['id'])) {

                    $id = strip_tags($_GET['id']);        
                    $id = $conn->real_escape_string($id);

                    if($id === $_SESSION['id']) {
                        header("Location: /account/index.php");
                    } else {

                        //echo($id);

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
                                <div class="w3-col m4">
                                    <div class="w3-margin w3-card w3-round w3-white">
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
                                                <div onclick="window.location='messages/messageform.php?id=<?php echo($user_id); ?>'" class="w3-green w3-button w3-half">
                                                    Bericht sturen
                                                </div>
                                                <div onclick="window.location='messages/friendform.php?id=<?php echo($user_id); ?>'" class="w3-blue w3-button w3-half">
                                                    Vrienden worden
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w3-col m7">
                                    <div class="w3-margin">

                                        <h3>Berichten</h3>
                                        <?php
                                            if(file_exists("posts.json") && filesize("posts.json") > 0){
                                                $handle = fopen("posts.json", "a+");
                                                $contents = fread($handle, filesize("posts.json"));
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
                                                            <button onclick="addLike('<?= $post->id ?>')" type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;<?= $post->likes ?></button>
                                                            <!--                            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button> -->
                                                        </div><br>
                                                        <?php
                                                    }    
                                                }
                                            }
                                        ?>
                                    </div>
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
                }
                ?>
            </div>
        </div>
        <script>
            function addLike(id) {
                var postId = id;
                console.log("gaaf!");
                $.post("public/addlike.php", {id: postId});
            }
        </script>
    </body>
</html>