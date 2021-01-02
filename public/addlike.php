<?php
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $contents = file_get_contents("../posts.json");
    $oldposts = json_decode($contents);
    
    $newposts = array();
    
    foreach ($oldposts as $post){
        if($post->id === $id) {
            $likes = $post->likes + 1;
            $newpost = array("image" => $post->image, "likes" => $likes, "id" => $post->id, "text" => $post->text, "auteur" => $post->auteur, "stemming" => $post->stemming, "datum" => $post->datum);
            array_push($newposts, $newpost); 
        }
        else {
            array_push($newposts, $post); 
        }
    }
    
    $fp = fopen("../posts.json", 'w+');
    fwrite($fp, json_encode($newposts));
    fclose($fp);
}