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
        <div class="center">Contact toevoegen</div>
    </ons-toolbar>
    <?php
    session_start();
    $account_id = $_GET['id'];

    if(!isset($_SESSION['login19'])) {
        $_SESSION['login19'] = false;
    }
    if($_SESSION['login19'] == true) {
    ?>
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
    </form> <?php } else {
        echo "Eerst inloggen! <a href='../inloggen.php'>Inloggen</a>";
    } ?>
</ons-page>