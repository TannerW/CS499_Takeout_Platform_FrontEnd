<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Ander's Kitchen | Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!---foundation styles--->
        <link rel="stylesheet" href="css/foundation.css" />

        <link rel="stylesheet" type="text/css" href="css/login.css"/> <!---my custom styles--->
        <link rel="stylesheet" type="text/css" href="css/masterStyles.css"/><!---my custom styles--->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" />

        <script src="js/vendor/modernizr.js"></script>
        <?php
        $cookie_name = "token";
        include 'PHPHelpers/getMyProfileButton.php';
        $result = getMyProfileButton();
        ?>
    </head>
    <body>
        <?php
        if ($result != "No token") {
            ?>
    <center>Uh oh! we already see someone signed in.</center>
            <div class='row'>
                <center><a class="button expanded" href="https://www.anderskitchen.com/PHPHelpers/signOut.php"><h3>Are you not <?php echo $result['email'];?>? Click here to sign out.</h3></a></center>
        </div>
        <div class='row'>
            <center><a class="button expanded" href="https://www.anderskitchen.com/customerPortal.php"><h3>If <?php echo $result['email'];?> is your account, then click here to go to your customer page and start your order!</h3></a></center>
        </div>
            <?php
        } else {
            ?>
        <form method="post" role="form" id="loginForm">
            <div class="row" id="email-div">
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Email

                            <?php
                            if (isset($result)) {
                                echo $result['abilities'];
                                echo "\n";
                                echo $result['email'];
                            }
                            ?> 
                            <input type="email" name="email" id="email" placeholder="Your email address">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="password-div">  
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Password
                            <input type="password" name="password" id="password" placeholder="Your Password">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 columns medium-centered">
                    <center>
                        <input class="button" name="signIn" type="submit" value="Sign In">
                    </center>
                </div>
            </div>
        </form>
        <br>
        <div class="row">
            <div class="medium-6 columns medium-centered">
                <center>
                    <a class="button" href="https://www.anderskitchen.com/newUser.php">Don't have an account? Click Here to make a free one!</a>
                </center>
            </div>
        </div>

        <?php } ?>
        <script src="js/vendor/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.js"></script>
        <script src="js/vendor/foundation.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script> <!---My custom jscript and jquery--->
        <script type="text/javascript" src="js/login.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
