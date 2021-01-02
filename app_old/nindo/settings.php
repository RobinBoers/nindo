<div class="modal-content">
    <span class="close">&times;</span>
    <h1>Instellingen</h1>
    <p><b>Verander wachtwoord:</b><br>
        Voer hieronder het nieuwe wachtwoord 2x in: 
    </p>
      <form method="post" name="password">

        <div class="input-group margin-bottom-sm">
          <span class="input-group-addon inputpassone"><i class="fa fa-user fa-fw"></i></span>
          <input class="text" minlength="6" class="form-control" name="passwordinput" id="passwordinput">
        </div>
        <div class="input-group">
          <span class="input-group-addon inputpasstwo"><i class="fa fa-key fa-fw"></i></span>
          <input class="text" minlength="6" class="form-control" ame="passwordcheck" id="passwordcheck">
        </div><br>
        <input type="button" value="Ok" name="submitpassword" id="submitpassword"><br><br>
          <p id="error">Voer 2x hetzelfde in!</p>
      </form>
  </div>
<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    <?php

    if(isset($_GET['settings'])){ 
        echo("modal.style.display = \"block\";");
    }

    ?>

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
</script>
<script>
$("#submitpassword").click(function(){
    var newpassword = $("#passwordinput").val();
    if($("#passwordinput").val() === $("#passwordcheck").val()) {
        console.log("Jahoe!");
        $("#passwordinput").attr("value", "");
        $("#passwordcheck").attr("value", "");
        $.post("pass_post.php", {password: newpassword});
    }
    else{
        console.log("Nop...");
    }
    return false;
});
</script>