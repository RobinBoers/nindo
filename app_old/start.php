<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="manifest" href="manifest.json">

<script>
ons.ready(function() {
  // Cordova APIs are ready
  console.log(window.device);
});
</script>

<!--
  <ons-page>
    <ons-toolbar>
      <div class="center">Nindo</div>
    </ons-toolbar>
-->

        <?php
        if($_SESSION['login19'] == true) {
        include("../connection.php");
            $user = $_SESSION['username'];
            $function = $_SESSION['nickname'];
            
            ?><ons-list>
            <ons-list-header>Profiel</ons-list-header>
            <ons-list-item><?php
            // Laat profiel zien:
            echo("<img height='64px' width='64px' style='margin-right:20px;float:left;' alt='profielfoto' src='/images/nindo/profiel.png'>".$user."<br>".$function."</span>");
            // Nu de berichten nog:
            ?>
            </ons-list-item></ons-list><br>
            <?php
                include("nindo/add.php");
            ?>
            <p style="clear:both!important;"></p>
            <ons-list-header>Berichten</ons-list-header>
            <ons-list>
            <?php
                if(file_exists("../posts.json") && filesize("../posts.json") > 0){
                    $handle = fopen("../posts.json", "a+");
                    $contents = fread($handle, filesize("../posts.json"));
                    $posts = json_decode($contents);
                    fclose($handle);

                    foreach($posts as $post){
                            ?>
                            
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
                                    $sql = "SELECT * FROM userinfo WHERE nickname = '$post->auteur' OR username = '$post->auteur'";
                                    $result = $conn->query($sql);

                                    if($result->num_rows == 1) {
                                        while($row = $result->fetch_object()) {
                                            $id = $row->id;
                                        }
                                    }?>
                            <ons-list-item class="postbericht" onclick="window.location = 'user.php?id=<?php echo $id; ?>';" tappable>
                                <h2><span style="color:royalblue;"><?= $post->auteur ?></span><span style="font-weight:100;font-size:16px;display:block;"><time><?= $post->datum ?></time></span></h2>
                                <p class="clearfix"></p>
                                <p class="clearfix blogtext"><?php echo(nl2br($post->text)) ?></p>
                            </ons-list-item>
                            <?php
                    }    
                } else {
                    echo("Hier is niks te vinden");
                }
            ?></ons-list>
            <style>#text {min-height: 200px;}</style>
            <?php
        }else{
            echo("<p>Je bent niet ingelogd! <a href='inloggen.php'>Inloggen</a>");
        }
        ?>

<!--  </ons-page>-->
<style>
    .stemming {
        float: none !important;
        border-top: none !important;
        border-bottom: none !important;
    }
    .newbericht {
        float: right !important;
        width: 100% !important;
        border-top: none !important;
        border-bottom: none !important;
    }
    .newbericht *, .stemming * {
        width: 100%;
    }
    .okbutton {
        margin-top: 10px;
    }
    .blogtext {
        display: block;
        clear: left;
    }
    .postbericht * {
        display: inline;
    }
    a {
        color: royalblue;
        text-decoration: none;
    }
</style>


