<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
session_start();
    if(isset($_POST['create'])) {
        include("../connection.php");
        $username = strip_tags($_POST['newname']);
        $loginname = strip_tags($_POST['newusername']);
        $password = strip_tags($_POST['newpassword']);
        $nickname = strip_tags($_POST['newnickname']);
        
        $username = $conn->real_escape_string($username);
        $loginname = $conn->real_escape_string($loginname);
        $password = $conn->real_escape_string($password);
        $nickname = $conn->real_escape_string($nickname);
        
//        $checkForOldAccounts = "SELECT id, username, password, nickname FROM userinfo WHERE username = '$username' AND nickname = '$nickname'";
        $checkForOldAccounts = "SELECT id, username, password, apps, nickname FROM userinfo WHERE loginname = '$loginname'";
                
        $result = $conn->query($checkForOldAccounts);
        
        if($result->num_rows == 0) {
            $newaccount = "INSERT INTO userinfo (id, username, loginname, password, apps, nickname, eemail) VALUES (NULL, '$username', '$loginname', '$password', 'nindo', '$nickname', '$loginname@geheimesite')";

            $create = $conn->query($newaccount);
            ?>
            <p>
                Je account is aangemaakt!<br>
                Als extra beveiliging moet je eerst nog inloggen.<br>
                <a href="inloggen.php">Inloggen</a>
            </p>
            <?php
        }
        else {
            ?>
                <p style="font-family:sans-serif;">
                    <b>Oeps!</b><br>
                    Er was al een account met die naam!<br>
                    <a href="aanmelden.php">Probeer opnieuw</a>
                </p>
                <?php
        }
    }
?>