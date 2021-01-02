<!DOCTYPE html>
<html>
    <head>
        <title>Nindo Chat</title>
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
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, {
            text-decoration: none !important;
        }
        .chatbox, #chatbox {
            max-height: 400px;
            width: 100%;
            overflow: auto;
        }
        </style>
    </head>
    <body class="w3-theme-l5">

        <?php
            include "../includable/nindo_header.php";
        ?>
        <script>
            var loc = true;
        </script>
        <div class="w3-container w3-margin w3-card w3-round w3-white w3-padding">
            <a style="text-decoration:none;" href="../index.php">&larr; Terug</a> | <a style="text-decoration:none;" id="exit" href="#">Uitloggen</a>
            <h2><b>Nindo</b> Chat</h2>
            <?php
                include "chat.php";
            ?>
        </div>
    </body>
</html>