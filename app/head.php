<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
<?php 
    session_start();
    if(!isset($_SESSION['login19'])) {
        $_SESSION['login19'] = false;
    }
?>
<style>
.content {
    padding-top:90px !important;
    padding-bottom:90px !important;
}
</style>