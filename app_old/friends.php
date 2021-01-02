<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="manifest" href="manifest.json">

<script>
ons.ready(function() {
  // Cordova APIs are ready
  console.log(window.device);
});
</script>
    <ons-list>
        <?php
        
        include("../connection.php");
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM contacten WHERE in_account_id = '$id'";
        $contacts = $conn->query($sql);
        if(!$contacts->num_rows == 0) {
            while($row = $contacts->fetch_object()) {
                ?>
                <ons-list-item onclick="window.location = 'user.php?id=<?php echo $row->account_id; ?>'" tappable>
                    <?php echo $row->name; ?>
                </ons-list-item>
                <?php
            }
        }
        ?>
    </ons-list>
