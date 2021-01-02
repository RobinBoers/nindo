<?php session_start(); ?>
<script>
var img = 'https://www.geheimesite.nl/logo2.png';
function notifyMe() {
  if (!("Notification" in window)) {
    alert("Sorry, jouw browser (ding waarmee je op het internet zit) ondersteund geen notificatie's, daarom kunnen we helaas geen push meldingen geven als je een berichtje krijgt. SORRY");
  }

  else if (Notification.permission === "granted") {
    var notification = new Notification('Nieuw bericht van '+from, { body: text, icon: img });
  }

  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      if (permission === "granted") {
        var notification = new Notification('Nieuw bericht van '+from, { body: text, icon: img });
      }
    });
  }
console.log("hallo");
}</script>
<?php
if($_SESSION['login19'] == true) { 
    function Notifications(){ ?>
        <?php
        include "../../connection.php";
        $account_id = $_SESSION["id"]; 
        $sql = "SELECT * FROM private_messages";
        $messages = $conn->query($sql);
        while($row = $messages->fetch_object()) {
            if($row->to_id == $account_id) {
                if($row->opend == "0" && $row->notify == "0") {
                    echo "<script>var text = '$row->text';
                    var from = '$row->from_name: $row->subject';
                    notifyMe();</script>";
                    $sql = "UPDATE `private_messages` SET `notify` = '1' WHERE `private_messages`.`id` = $row->id;";
                    $updatemsg = $conn->query($sql);
                }
            } 
            else { 
                //echo "Je kan het bericht niet bekijken met dit account!";
            }
        }
    }
}Notifications();
?><script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script>
setInterval(function(){ location.reload(); }, 500);
</script>