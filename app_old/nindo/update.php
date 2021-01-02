<?php
session_start();
if($_SESSION['login19'] === true){
    
    $text = $_POST['posttext-edit'];
    $id = $_POST['id'];
    $auteur = $_SESSION['i_name'];
    
    $contents = file_get_contents("../../posts.json");
    $oldposts = json_decode($contents);
    
    $newposts = array();
    
    foreach ($oldposts as $post){
        if($post->id === $id) {
            $stemming = $post->stemming;
            $datum = $post->datum;
            $Nid = $post->id;
            $newpost = array("id" => $Nid, "text" => $text, "auteur" => $auteur, "stemming" => $stemming, "datum" => $datum);
            array_push($newposts, $newpost); 
        }
        else {
            array_push($newposts, $post); 
        }
    } 
    
    $fp = fopen("../../posts.json", 'w+');
    fwrite($fp, json_encode($newposts));
    fclose($fp);
    header('Location: ../index.php');
    
}
else {
    echo("
    <p class='error'>
        U bent niet ingelogd en hebt daarom geen toegang tot deze pagina.<br>
        <a href='../inloggen.php'>Inloggen</a>
    </p>
    ");
}
?>
