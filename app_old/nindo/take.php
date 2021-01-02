<div class="post">
<?php
include("../connection.php");
if(file_exists("../posts.json") && filesize("../posts.json") > 0){
    $handle = fopen("posts.json", "a+");
    $contents = fread($handle, filesize("../posts.json"));
    $posts = json_decode($contents);
    fclose($handle);
    
    foreach($posts as $post){
            ?>
            <div class="bericht">
                <?php
                    if($_SESSION['login19'] == true){ 
                ?>
                    <!-- Editbar gebruiker, uitgeschakeld, niet in gebruik -->
                    <!--<p class="right">
                        <a href="nindo/edit.php?id=<?= $post->id ?>">Edit</a>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="nindo/del.php?id=<?= $post->id ?>">Verwijder</a>
                    </p>-->
                <?php
                    }
                    $sql = "SELECT * FROM userinfo WHERE nickname = '$post->auteur'";
                    $result = $conn->query($sql);

                    if($result->num_rows == 1) {
                        while($row = $result->fetch_object()) {
                            $id = $row->id;
                        }
                    }
                ?>
                <h2><a href="user.php?id=<?php echo $id; ?>"><?= $post->auteur ?></a><span style="font-weight:100;font-size:16px;display:block;"><time><?= $post->datum ?></time></span></h2>
                <p class="clearfix"></p>
                <p class="clearfix blogtext"><?php echo(nl2br($post->text)) ?></p>
            </div>
            <?php
    }    
} else {
    echo("Hier is niks te vinden");
}
?>    
</div>