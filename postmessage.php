<?php
include "connection.php";
    if(isset($_POST['to_id'])) {
        $to_id = $_POST['to_id'];
        $from_user = $_POST['from_name'];
        $from_id = $_POST['from_id'];
        $text = $_POST['text'];
        $time = date('h:i');
        
        $createMsg = "INSERT INTO messenger (id, to_id, from_id, from_name, time_sent, text, opend) VALUES (NULL, '$to_id', '$from_id', '$from_user', '$time', '$text', '0')";
        $create = $conn->query($createMsg);
        
    }
?>