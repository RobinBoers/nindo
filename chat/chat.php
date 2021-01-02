<?php
    if (!isset($_SESSION['login19'])) {
    $_SESSION['login19'] = false;
    }
    function loginForm(){
        if($_SESSION['login19'] == true) {
            include("../connection.php");
            $user = $_SESSION['username'];
            $nickname = $_SESSION['nickname'];
            $_SESSION['name'] = "$user [$nickname]";
            header("Location: index.php");
        } else {
            ?>
                <h1>Inloggen vereist</h1>
            <?php
            echo "<p>Je moet of <a href='../../inloggen.php'>Inloggen</a> of je betreed de Chat als gast, in dat geval vul je hieronder je nickname in:<br><br>";
            echo '
            <form action="index.php" method="post">
                <label for="name">Nickname:</label>
                <input type="text" name="name" id="name" />
                <input type="submit" name="enter" id="enter" value="Claim!" />
            </form></p>
            ';
        }

    }

    if(isset($_POST['enter'])){
        if($_POST['name'] != ""){
            $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
        }
        else{
            echo '<span class="error">Please type in a name</span>';
        }
    }

    if(!isset($_SESSION['first'])) {
        $_SESSION['first'] = true;
    }
    if($_SESSION['first'] == true && $_SESSION['login19'] == true) {
        echo("<script>window.location.replace(\"index.php\")</script>");
        $_SESSION['first'] = false; 
    }
?>
<?php
    if(isset($_GET['logout'])){ 

    //Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='go'><i>". $_SESSION['name'] ." heeft de chat verlaten</i><br></div>");
    fclose($fp);

    $_SESSION['login19'] = false;
    session_unset();
    session_destroy();
    echo("<script>window.location.replace(\"../index.php\")</script>");
    }
    if(!isset($_SESSION['name'])){
        loginForm();
    }
    else{
?>

<div class="chatbox" id="chatbox">
<?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);

    echo $contents;
}
?>
</div>
<hr>
<p>Bericht:</p>
<form method="post" name="message" action="">
    <input name="usermsg" type="text" id="usermsg">
    <input name="submitmsg" type="submit"  id="submitmsg" value="Send">
</form>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){ //2500 old
    setInterval (loadLog, 500);	//Reload file every 2500 ms or x ms if you wish to change the second parameter
    //Als de gebruiker wil stoppen met chatten
    $("#exit").click(function(){
        var exit = confirm("Wil je echt stoppen met chatten?");
        if(exit==true){window.location = 'index.php?logout=true';}		
    });
    if(loc === true) {
        //If user submits the form
        $("#submitmsg").click(function(){	
            var clientmsg = $("#usermsg").val();
            $.post("post.php", {text: clientmsg});				
            $("#usermsg").attr("value", "");
            return false;
        });
    }
    if(loc === false) {
        //If user submits the form
        $("#submitmsg").click(function(){	
            var clientmsg = $("#usermsg").val();
            $.post("chat/post.php", {text: clientmsg});				
            $("#usermsg").attr("value", "");
            return false;
        });
    }
    //Load the file containing the chat log
    function loadLog(){		
        var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
        if(loc === true){
            $.ajax({
                url: "log.html",
                cache: false,
                success: function(html){		
                    $("#chatbox").html(html); //Insert chat log into the #chatbox div	

                    //Auto-scroll			
                    var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                    if(newscrollHeight > oldscrollHeight){
                        $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                    }				
                },
            });
        }
        if(loc === false){
            $.ajax({
                url: "chat/log.html",
                cache: false,
                success: function(html){		
                    $("#chatbox").html(html); //Insert chat log into the #chatbox div	

                    //Auto-scroll			
                    var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                    if(newscrollHeight > oldscrollHeight){
                        $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                    }				
                },
            });
        }
    }
});   
</script>
<?php
    }


?>