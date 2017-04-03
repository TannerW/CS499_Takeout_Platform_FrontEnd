<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Ander's Kitchen | Hello valued customer!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!---foundation styles--->
        <link rel="stylesheet" href="css/foundation.css" />

        <link rel="stylesheet" type="text/css" href="css/customerPortal.css"/> <!---my custom styles--->
        <link rel="stylesheet" type="text/css" href="css/masterStyles.css"/><!---my custom styles--->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" />

        <script src="js/vendor/modernizr.js"></script>
    </head>
    <body>
        <?php
        if ($permission == "False") {
            ?>
            You Really Shouldn't Be Here.. go to: https://www.anderskitchen.com/login.php to log in.
            <?php
        } else {
            ?>
            You're on the customer page... it just hasnt been built yet.
        <?php } ?>
    </body>
</html>
