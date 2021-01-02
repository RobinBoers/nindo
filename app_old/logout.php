<?php

session_start();
$_SESSION['login19'] = false;
session_destroy();
header('Location: index.php');
exit();

?>