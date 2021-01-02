<?php 
include "connection.php";
session_start();
$account_id = $_SESSION["id"]; 
$to_id = $_SESSION["contact_id"]; 

$sql2 = "SELECT * FROM messenger WHERE (to_id = '$to_id' AND from_id = '$account_id') OR (to_id = '$account_id' AND from_id = '$to_id')";
    $findmessage = $conn->query($sql2);

    while($row = $findmessage->fetch_object()) {

        if($row->to_id == $account_id) { ?>
            <div class="w3-cell w3-left w3-card w3-margin w3-clear w3-round w3-white">
        <?php } else { ?>
            <div class="w3-cell w3-right w3-card w3-margin w3-clear w3-round w3-white">
        <?php } ?>
                <div class="w3-container">

                        <?php if($row->to_id == $account_id) { ?>
                            <p class="w3-margin">
                        <?php } else { ?>
                            <p class="w3-right w3-margin">
                        <?php } ?>

                                <a style="text-decoration:none;" href="user.php?id=<?php echo $row->from_id ?>">
                                    <i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i>
                                    <b><?php echo $row->from_name ?></b>
                                </a>
                                <span style="padding-top:11px;display:block;">
                                    <?php echo(nl2br($row->text)) ?>
                                </span>
                            </p>
                    <p style="clear:right;"></p>
                    <p class="w3-right"><?php echo($row->time_sent) ?></p>
                </div>
            </div>
            <p style="clear:both;"></p>
        <?php
    } ?>