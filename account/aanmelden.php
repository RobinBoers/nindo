<!DOCTYPE html>
<html>
    <head>
        <title>
            Aanmelden - Nindo
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="frame">
            <?php
                include "../includable/nindo_header.php";
            ?>
            <main>
                <section class="w3-container">
                    <h2>Aanmelden</h2>
                    <form action="create-account.php" method="post">
                        <label for="newusername">Voer hier je gebruikersnaam in:</label><br>
                        <input type="text" name="newusername"><br>
                        <label for="newusername">Voer hier je naam in:</label><br>
                        <input type="text" name="newname"><br>
                        <label for="newnickname">Voer hier je nicknaam in:</label><br>
                        <input type="text" name="newnickname"><br>
                        <label for="newpassword">Voer hier je wachtwoord in:</label><br>
                        <input type="password" name="newpassword"><br>
                        <input type="submit" name="create" value="Aanmaken" />
                        <p class="formlink">Heb je al een account? <a href="inloggen.php">Inloggen</a><br>Door een account aan te maken, accepteer je de <a href="gebruikersvoorwaarden.php">gebruikersvoorwaarden</a></p>
                    </form>
                </section>
            </main>
        </div>
    </body>
</html>