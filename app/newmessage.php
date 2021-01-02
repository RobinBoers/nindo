<html>
    <head>
        <link rel="manifest" href="manifest.json">
        <link rel="stylesheet" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?php
            include "head.php";
        ?>
    </head>
    <body>
        <div class="head-section w3-red w3-bar w3-wide w3-padding">
            <p>NIEUW BERICHT</p>
        </div>
        <div class="content w3-margin-left w3-margin-right">
            <?php
                include "../connection.php";
                if($_SESSION['login19'] == true) {
            ?>
            <form action="sendmsg.php" method="post">
                <table>
                    <tr>
                        <td>Onderwerp:</td><td><input type="text" placeholder="Onderwerp" name="subject"></td>
                    </tr>
                    <?php if(isset($_GET['id'])) {
                        $id_to = $_GET['id']; ?>
                        <input type="hidden" placeholder="Verzenden naar" name="to_id" value="<?php echo $id_to ?>"><?php } else{ ?>
                    <tr>
                        <td>Aan:</td>
                        <td>
                            <input type="text" placeholder="Aan" name="to" >
                        </td>
                    </tr><?php } ?>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td>Bericht: </td><td><textarea name="msgtext"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <input type="hidden" placeholder="Verzenden vanaf" name="from" value="<?php echo $_SESSION['username'] ?>">
                    <input type="hidden" placeholder="Verzenden vanaf" name="from_id" value="<?php echo $_SESSION['id'] ?>">
                    <tr>
                        <td colspan="2"><input width="100%;" type="submit" name="send" id="send" value="Verzenden"></td>
                    </tr>
                </table>
            </form> 
            <?php } else { echo "<p>Je moet ingelogd zijn om dit te bekijken. <a href='inloggen.php'>Inloggen</a></p>"; } ?>
        </div>
        <div class="navigation">
            <?php
                include "nav.php";
            ?>
        </div>
    </body>
</html>