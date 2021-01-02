<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="manifest" href="manifest.json">

<script>
ons.ready(function() {
  // Cordova APIs are ready
  console.log(window.device);
});
</script>
<!--
<ons-page>
    <ons-toolbar>
      <div class="center">Berichten</div>
    </ons-toolbar>
-->
    <?php
        include "messages/inbox.php";
    ?>
    <?php
        include "messages/sent.php";
    ?>
<!--</ons-page>-->