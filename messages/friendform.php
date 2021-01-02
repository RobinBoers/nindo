<!DOCTYPE html>
<html>
    <head>
        <title>Nindo</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        button, input, textarea {
            outline: none;
        }
        #inbox19 a, #sent19 a, #friends19 a {
            text-decoration: none;
        }
        </style>
    </head>
    <body class="w3-theme-l5">

        <?php
            include "../includable/nindo_header.php";
            include "../connection.php";
            $account_id = $_GET['id'];

            if($_SESSION['login19'] == true) {
            ?>
            <div class="w3-container w3-card w3-white w3-round w3-margin w3-padding">
                <form action="addcontact.php" method="post">
                    <table>
                        <tr>
                            <td>Naam:</td><td><input type="text" placeholder="Naam" name="name"></td><td>Deze wordt in de contactenlijst weergegeven</td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <input type="hidden" placeholder="" name="id" value="<?php echo $account_id ?>">
                        <tr>
                            <td colspan="2"><input width="100%;" type="submit" name="add" id="add" value="Opslaan"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php } else {
            echo "Eerst inloggen! <a href='../../inloggen.php'>Inloggen</a>";
        } ?>
    </body>
</html>