<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <!---------------------------------------------
    ===============================================
    This is a part of RobinDev New Website
      _____       _     _       _____             
     |  __ \     | |   (_)     |  __ \            
     | |__) |___ | |__  _ _ __ | |  | | _____   __
     |  _  // _ \| '_ \| | '_ \| |  | |/ _ \ \ / /
     | | \ \ (_) | |_) | | | | | |__| |  __/\ V / 
     |_|  \_\___/|_.__/|_|_| |_|_____/ \___| \_/  

    RobinDev
    Made by: Robin Boers
    Title: inlog page
    Development data: 10-04-2019 t/m ##-##-####
    Online since: ##-##-####
    Subject: New Inlogpage
    =====================================================
    ---------------------------------------------------->
    
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta lang="nl" />
    <meta name="language" content="nederland" />
    <meta http–equiv="content–language" content="nl" />
    <meta http-equiv="language" content="NL" />
    <meta name="application-name" content="geheimesite.nl" />
    <meta name="reply-to" content="robin@geheimesite.nl" />
    <link rel="stylesheet" type="text/css" href="../../css/main1.css"> 
</head>
<body>
    <div class="background">
    <main>
        <article>
            <h2 class="formkop">Inloggen</h2>
            <form method="post" action="login.php">
                <label for="username">Gebruikersnaam</label>
                <input type="text" name="username" />
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" />
                <input type="submit" name="login" value="Login" />
            </form>
        </article>
    </main>
    </div>
</body>
</html>