<!doctype html>
<html class="no-js" lang="en">

    <head>
        <!---Foundations head content--->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ander's Kitchen | Welcome</title>
        <!---foundation styles--->
        <!--        <link rel="stylesheet" href="css/Foundation5/css/foundation.css" />-->
        <link rel="stylesheet" href="css/foundation.css" />

        <link rel="stylesheet" type="text/css" href="css/main.css"/> <!---my custom styles--->
        <link rel="stylesheet" type="text/css" href="css/masterStyles.css"/> <!---my custom styles--->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" />

        <script src="js/vendor/modernizr.js"></script>

        <?php
        $cookie_name = "token";
        ?>

    </head>

    <body>
        <div class='row'>
            <center>
                <h1>Ander's Kitchen</h1>
            </center>
        </div>
        <div class='row'>
            <center>
                <a class="button expanded" href="login.php"><h3>Returning Customer? Click Here to Sign In!</h3></a>
            </center>
        </div>
        <div class='row'>
            <center>
                <a class="button expanded" href="login.php"><h3>New Customer? Click Here to Make a Free Account!</h3></a>
            </center>





        </div>
        <div class='row'>
            <ul class="tabs" data-tabs id="menu">
                <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">This Week's Meals</a></li>
                <li class="tabs-title"><a href="#panel2">About Us</a></li>
                <li class="tabs-title"><a href="#panel3">Contact Us</a></li>
            </ul>
        </div>
        <div class='row'>
            <div class="tabs-content" data-tabs-content="menu">
                <div class="tabs-panel is-active" id="panel1">
                    <p>Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
                </div>
                <div class="tabs-panel" id="panel2">
                    <p>Suspendisse dictum feugiat nisl ut dapibus.  Vivamus hendrerit arcu sed erat molestie vehicula. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.  Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
                </div>
                <div class="tabs-panel" id="panel3">
                    <p>Here is a panel with our contact information.<?php echo "hello!"; ?></p>
                </div>
            </div>
        </div>


        <script src="js/vendor/jquery.js"></script>
        <script src="js/vendor/foundation.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script> <!---My custom jscript and jquery--->
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
