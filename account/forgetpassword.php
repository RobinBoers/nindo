<style>
    body {
        width: 300px;
        margin: auto;
        padding: 100px;
    }
</style>
<h1>Wachtwoord opvragen</h1>
<p>Je kunt hier als je een emailadres in je account hebt opgeslagen, je wachtwoord opvragen</p>
<form method="post">
    <p>Gebruikersnaam:</p>
    <input name="name" type="text" spellcheck="false" placeholder="Vul hier uw gebruikersnaam in..."><br>
    <input name="forget" value="Opvragen" type="submit">
</form>
<?php
session_start();
    if(isset($_POST['forget'])) {
        include("../connection.php");
        $username = strip_tags($_POST['name']);
        $username = $conn->real_escape_string($username);
        
        $checkForAccounts = "SELECT * FROM userinfo WHERE username = '$username'";
                
        $result = $conn->query($checkForAccounts);
        
        if($result->num_rows == 1) {
            while($row = $result->fetch_object()) {
                $email = $row->email;
                $pswd = $row->password;
                
                $msg = "U hebt op de knop 'Wachtwoord vergeten' geklikt \n Hebt u niet  op deze knop geklikt, dan kunt u deze e-mail negeren.\n Het wachtwoord is: $pswd \n\n\n Dit is een automatische e-mail waarin het wachtwoord van uw DGAW, Nindo, GeheimAgent of geheimesite-account wordt opgestuurd.";

                $msg = wordwrap($msg,70);

                mail($email,"Uw wachtwoord",$msg);
            ?>
            <p>
                <b>Email verstuurd</b><br>
                Er is een automatische email naar uw account verstuurd.<br>
                <a href="../index.php">OK</a>
            </p>
            <?php
            }
        }
        else {
            ?>
                <p>
                    <b>Oeps!</b><br>
                    Het was helaas niet mogelijk een email te versturen naar uw emailadres, het spijt me<br>
                    <a href="index.php">OK</a>
                </p>
                <?php
        }
    }
?>