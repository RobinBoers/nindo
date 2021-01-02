<?php
session_start();
include "../connection.php";
    if(isset($_POST['add'])) {
        $account_id = $_POST['id'];
        $in_account_id = $_SESSION['id'];
        $name = $_POST['name'];
        
        $createContact = "INSERT INTO contacten (id, name, in_account_id, account_id) VALUES (NULL, '$name', '$in_account_id', '$account_id')";
        $create = $conn->query($createContact);
        
        header("Location: ../index.php");
    }
?>