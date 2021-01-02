<?php
include "../connection.php";
    if(isset($_POST['send'])) {
        $subject = $_POST['subject'];
//        $to_id = $_POST['to_id'];
        $from_user = $_POST['from'];
        $from_id = $_POST['from_id'];
        $text = $_POST['msgtext'];
        if(isset($_POST['to'])) {
            $email_to = $_POST['to'];
            if (!preg_match("/@geheimesite.nl/", $email_to)) {
                echo "Het is geen geheimesiteadres";
                $to_id = $email_to;
                
                $sql = "SELECT * FROM userinfo WHERE id = '$from_id'";
                $zoekenNaarUser = $conn->query($sql);
                if($zoekenNaarUser->num_rows == 1) {
                    while($row = $zoekenNaarUser->fetch_object()) {
                        $emailadres1 = $row->email;
                    }
                }
                
                if(!$emailadres1 == "") {
                        echo "ik ga mail versturen";
                        
                        // In case any of our lines are larger than 70 characters, we should use wordwrap()
                        $text = wordwrap($text, 70, "\r\n");

                        // Send
                        mail($email_to, $subject, $text, $headers = 'From: ' . $emailadres1 . "\r\n" . 'Reply-To: ' . $emailadres1 . "\r\n" . 'X-Mailer: PHP/' . phpversion());
                } else {
                    echo "<br><br>Er is geen e-mailadres in uw account toegevoegd. Om email's te versturen naar emailadressen die niet van geheimesite zijn, moet u een gmail, outlook, of een ander e-mailadres aan uw account toevoegen. Dat kan in <a href='../../apps.php'>Account instellingen</a>";
                    exit();
                }
            } else {
                $email_to = $conn->real_escape_string($email_to);
                $sql = "SELECT * FROM userinfo WHERE eemail = '$email_to'";

                $result = $conn->query($sql);

                if($result->num_rows == 1) {
                    while($row = $result->fetch_object()) {
                        $to_id = $row->id;
                    }
                }
                else {
                    echo("<br><br>emailadres bestaat niet!");
                    exit();
                }
            }
            
        } else {
            $to_id = $_POST['to_id'];
        }
        $time = date('l jS \of F Y');
        
        $createMsg = "INSERT INTO private_messages (id, to_id, from_id, from_name, time_sent, subject, text, opend, notify) VALUES (NULL, '$to_id', '$from_id', '$from_user', '$time', '$subject', '$text', '0', '0')";
        $create = $conn->query($createMsg);
        
        header("Location: ../index.php");
    }
?>