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
            if(isset($_POST['add'])) {
                $account_id = $_POST['id'];
                $in_account_id = $_SESSION['id'];
                $name = $_POST['name'];

                $createContact = "INSERT INTO contacten (id, name, in_account_id, account_id) VALUES (NULL, '$name', '$in_account_id', '$account_id')";
                $create = $conn->query($createContact);

                header("Location: ../index.php");
            }
        ?>
    </body>
</html>