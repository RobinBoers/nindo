<?php
session_start();
if($_SESSION['login19'] === true){
    
    $text = $_POST['text'];
    $stemming = $_POST['stemming'];
//    $datum = date("l, j F Y, H:i");
    $datum = date("j F, H:i");
//    $auteur = $_SESSION['username'];
    $auteur = $_SESSION['nickname'];
    $id = uniqid();
    
    $d_post = array("id" => $id, "stemming" => $stemming, "text" => $text, "auteur" => $auteur, "datum" => $datum);
    
    $oldercontent = file_get_contents("../../posts.json");
    $posts = json_decode($oldercontent);
    
    array_unshift($posts, $d_post);
    
    $fp = fopen("../../posts.json", 'w+');
    fwrite($fp, json_encode($posts));
    fclose($fp);
    echo("Success!");
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
