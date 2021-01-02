<link rel="manifest" href="../manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Onsen UI -->
<link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
<link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
<script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
<?php
        include "../head.php";
    ?>
<ons-page>
    <ons-toolbar>
        <ons-back-button onclick="window.location = '../index.php'">Terug</ons-back-button>
        <div class="center">Bericht versturen</div>
    </ons-toolbar>
    <?php
    session_start();
    $id_to = $_GET['id'];

    if(!isset($_SESSION['login19'])) {
        $_SESSION['login19'] = false;
    }
    if($_SESSION['login19'] == true) {
    ?>
    <form action="sendmsg.php" method="post">
        <table>
            <tr>
                <td>Onderwerp:</td><td><input type="text" placeholder="Onderwerp" name="subject"></td>
            </tr>
    <!--
            <tr>
                <td>Aan:</td>
                <td>
                    <input type="text" placeholder="Aan" name="to" >
                </td>
            </tr>
    -->
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
            <input type="hidden" placeholder="Verzenden vanaf" name="to_id" value="<?php echo $id_to ?>">
            <tr>
                <td colspan="2"><input width="100%;" type="submit" name="send" id="send" value="Verzenden"></td>
            </tr>
        </table>
    </form> <?php } else {
        echo "Eerst inloggen! <a href='inloggen.php'>Inloggen</a>";
    } ?>
</ons-page>