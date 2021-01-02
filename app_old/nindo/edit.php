<?php
//    error_reporting(0);
    if(!isset($_SESSION)) {
        session_start();
    }
    if($_SESSION['login19'] === true){ 
        $id = $_GET['id'];
    ?>
    
        <!-- In de stylesheet staan de verwijzingen naar het thema, de stylesheet voor de positie van dingen, en de door de gebruiker ingevoerde css (in de editor) -->
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <h2 class="wit">Bewerk een post:</h2>
        <form method="post" name="post-edit" action="update.php">
            <p class="wit">
                <b>Nieuwe tekst:</b><br>
                <?php echo("Id is: ".$id."<br>") ?>
            </p>
            
            <input type="hidden" name="id" value="<?php echo($id); ?>">
            
            <textarea name="posttext-edit" id="posttext-edit"><?php
                if(file_exists("../../posts.json") && filesize("../../posts.json") > 0){
                $handle = fopen("../../posts.json", "a+");
                $contents = fread($handle, filesize("../../posts.json"));
                $posts = json_decode($contents);
                fclose($handle);
                    foreach ($posts as $post){
                        if($post->id === $id) {
                        echo($post->text);
                        }
                    }    
                }
            ?></textarea>
            <br><br><br>

            <input name="submit-edit" type="submit"  id="submit-edit" value="Opslaan">
        </form>
    <?php
        }
        else {
    ?>
        <title>Je bent niet ingelogd</title>

        <!-- In de stylesheet staan de verwijzingen naar het thema, de stylesheet voor de positie van dingen, en de door de gebruiker ingevoerde css (in de editor) -->
        <link rel="stylesheet" type="text/css" href="../../../css/main1.css">

        <!-- Hier kan de gebruiker zijn blognaam / naam / nickname invoeren, waarmee hij de blogberichten post. -->

    <p class='error'>
        U bent niet ingelogd en hebt daarom geen toegang tot deze pagina.<br>
        <a href='../inloggen.php'>Inloggen</a>
    </p>
    <?php
    }
    ?>
