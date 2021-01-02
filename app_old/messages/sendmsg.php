<?php

include "../../connection.php";
    if(isset($_POST['send'])) {
        $subject = $_POST['subject'];
        $to_id = $_POST['to_id'];
        $from_user = $_POST['from'];
        $from_id = $_POST['from_id'];
        $text = $_POST['msgtext'];
        $time = date('l jS \of F Y');
        
        $createMsg = "INSERT INTO private_messages (id, to_id, from_id, from_name, time_sent, subject, text, opend, notify) VALUES (NULL, '$to_id', '$from_id', '$from_user', '$time', '$subject', '$text', '0', '0')";
        $create = $conn->query($createMsg);
        
        header("Location: ../index.php");
    }
?>