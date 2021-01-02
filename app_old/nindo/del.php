<?php
session_start();
if($_SESSION['login19'] === true){
    
    $id = $_GET['id'];
    $datum = date("l, j F Y");
    $auteur = $_SESSION['i_name'];
    
    $contents = file_get_contents("../../posts.json");
    $oldposts = json_decode($contents);
    
    $newposts = array();
    
    foreach ($oldposts as $post){
        if($post->id === $id) {
            echo("Verwijderd!");
        }
        else {
            array_push($newposts, $post); 
        }
    } 
    
    $fp = fopen("../posts.json", 'w+');
    fwrite($fp, json_encode($newposts));
    fclose($fp);
    header('Location: ../index.php');
    
}
else {
    echo("
    <p class='error'>
        U bent niet ingelogd en hebt daarom geen toegang tot deze pagina.<br>
        <a href='../../inloggen.php'>Inloggen</a>
    </p>
    ");
}
?>
