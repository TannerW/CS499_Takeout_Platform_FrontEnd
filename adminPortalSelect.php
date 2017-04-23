<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Ander's Kitchen | Admin Portal Select</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/foundation.css" /> <!--foundation styles-->
        <link rel="stylesheet" type="text/css" href="css/masterStyles.css"/><!---my custom styles--->

        <?php
        include 'PHPHelpers/permissionPolicer.php';
        $permission = permissionPolicer();
        ?>
    </head>

    <body>
        <?php
        if ($permission == "False") {
            ?>
            You Really Should Be Here.. go to: https://www.anderskitchen.com/login.php to log in.
            <?php
        } else {
            ?>
            <div class='row'>
                <center><a class="button expanded" href="https://www.anderskitchen.com/ownerPortal.php"><h3>Admin Portal</h3></a></center>
            </div>
            <div class='row'>
                <center><a class="button expanded" href="https://www.anderskitchen.com/driverPortal.php"><h3>Driver Portal</h3></a></center>
            </div>
            <div class='row'>
                <center><a class="button expanded" href="https://www.anderskitchen.com/customerPortal.php"><h3>Customer Portal</h3></a></center>
            </div>
        <?php } ?>
        <script type="text/javascript" src="js/vendor/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/foundation.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script> <!---My custom jscript and jquery--->
        <script type="text/javascript">
            $(document).foundation();
        </script>
    </body>
</html>