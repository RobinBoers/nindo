<p>
</p>
<ons-list-header>Inbox</ons-list-header>
<ons-list><?php
$id = $_SESSION["id"]; 
$sql = "SELECT * FROM private_messages WHERE to_id = '$id' ORDER BY `private_messages`.`id` DESC";

$inbox = $conn->query($sql);
if(!$inbox->num_rows == 0) {
        while($row = $inbox->fetch_object()) {
            ?>
            <ons-list-item class="postbericht" onclick="window.location = 'messages/message.php?id=<?php echo $row->id; ?>'" tappable>
                <h4><b><?php echo $row->subject; ?></b> <span style="display:block;font-size:14px;">[<i><?php echo $row->time_sent; ?></i>]</span></h4>
            </ons-list-item>
            <?php
        }
}?></ons-list>