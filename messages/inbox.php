<?php
    session_start();
    include("../connection.php");

    $id = $_SESSION["id"]; 
    $sql = "SELECT * FROM private_messages WHERE to_id = '$id' ORDER BY `private_messages`.`id` DESC";

    $inbox = $conn->query($sql);
    if(!$inbox->num_rows == 0) {
        while($row = $inbox->fetch_object()) {
            ?>
            <div class="w3-full">
                <a href="messages/message.php?id=<?php echo $row->id; ?>">
                    <p>
                        <b><?php echo $row->subject; ?></b><br>
                        <span><i><?php echo $row->time_sent; ?></i></span>
                    </p>
                </a>
            </div>
            <?php
        }
    }?>