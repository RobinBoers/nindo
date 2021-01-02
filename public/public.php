<a href="../connection.php"></a>
<?php
    session_start();
    include "../connection.php";

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
                    $profile_picture_feed = $row->profile;
                            
                    if($profile_picture_feed == "") {
                        $profile_picture_feed = "/images/nindo/profiel.png";
                    }
                }
            }
            ?>
            <div class="w3-container post22222 w3-card w3-white w3-round w3-margin-bottom"><br>
                <img src="<?php echo $profile_picture_feed ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px;height:60px;">
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
                        <img src="<?php echo($post->image) ?>">
                        <?php
                    } ?>
                </p>
                <button onclick="addLike('<?= $post->id ?>')" type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;<?= $post->likes ?></button> 
<!--                            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button> -->
            </div>
            <?php
        }    
    }
?>