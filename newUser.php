<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Ander's Kitchen | New User</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!---foundation styles--->
        <link rel="stylesheet" href="css/foundation.css" />

        <link rel="stylesheet" type="text/css" href="css/newUser.css"/> <!---my custom styles--->
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
        require_once './httpful.phar';
// define variables and set to empty values
        $passwordErr = $emailErr = $firstNameErr = "";
        $firstName = $lastName = $password = $email = $phone = $street1 = $street2 = $city = $state = $zip_code = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
            } else {
                $password = test_input($_POST["name"]);
            }

            if (empty($_POST["firstName"])) {
                $firstNameErr = "First Name is required";
            } else {
                $firstName = test_input($_POST["name"]);
            }

            if (!(empty($_POST["firstName"]) || empty($_POST["password"]) || empty($_POST["email"]))) {
                $sendinfo = True;
            } else {
                $sendinfo = False;
            }

            $data = array(
                'email' => $_POST["email"],
                'password' => $_POST["password"],
                'profile' => array(
                    'first_name' => $_POST["firstName"],
                    'last_name' => $_POST["lastName"],
                    'phone' => $_POST["phone"],
                    'street_1' => $_POST["street1"],
                    'street_2' => $_POST["street2"],
                    'city' => $_POST["city"],
                    'state' => $_POST["state"],
                    'zip_code' => $_POST["zip"]
                ),
            );

            if ($sendinfo) {
                $requesturl = "https://www.anderskitchen.com:9000/user"; //request url


                $response = \Httpful\Request::post($requesturl)->sendsJson()->body($data)->send();

                
                //echo $response;
                $string = json_decode($response, true);
                //echo $string['Error'];
                //echo isset($string['Error']);
                
                $firstName = $lastName = $password = $email = $phone = $street1 = $street2 = $city = $state = $zip_code = "";

                if(isset($string['Error'])){
                    echo $string['Error'];
                }else{
                header("Location: https://www.anderskitchen.com/login.php"); /* Redirect browser */
                exit();
                }
                
            }
        }

        function test_input($check) {
            $check = trim($check);
            $check = stripslashes($check);
            $check = htmlspecialchars($check);
            return $check;
        }
        ?>

        <?php
        if ($result != "No token") {
            ?>
        <center>Uh oh! we already see someone signed in.</center>
        <div class='row'>
            <center><a class="button expanded" href="https://www.anderskitchen.com/PHPHelpers/signOut.php"><h3>Are you not <?php echo $result['email']; ?>? Click here to sign out.</h3></a></center>
        </div>
        <div class='row'>
            <center><a class="button expanded" href="https://www.anderskitchen.com/customerPortal.php"><h3>If <?php echo $result['email']; ?> is your account, then click here to go to your customer page and start your order!</h3></a></center>
        </div>
    <?php } else { ?>

        <form method="post" role="form" id="newUserForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row" id="email-div">
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Email <span class="error"><bold>* <?php echo $emailErr; ?></bold></span>
                            <input type="email" name="email" id="email" placeholder="Your email address">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="password-div">  
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Password <span class="error"><bold>* <?php echo $passwordErr; ?></bold></span>
                            <input type="password" name="password" id="password" placeholder="Your Password">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="firstName-div">
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>First Name <span class="error"><bold>* <?php echo $firstNameErr; ?></bold></span>
                            <input type="text" name="firstName" id="firstName" placeholder="First Name">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="lastName-div">
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Last Name
                            <input type="text" name="lastName" id="lastName" placeholder="Last Name">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="phoneName-div">
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Phone Number
                            <input type="tel" name="phone" id="phone" placeholder="Phone Number">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="street1-div">  
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Street 1:
                            <input type="text" name="street1" id="street1" placeholder="Street 1">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="street2-div">  
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Street 2:
                            <input type="text" name="street2" id="street2" placeholder="Street 2">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="city-div">  
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>City:
                            <input type="text" name="city" id="city" placeholder="City">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="state-div">  
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>State:
                            <input type="text" name="state" id="state" placeholder="State">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row" id="zip-div">  
                <div class="medium-6 columns medium-centered">
                    <center>
                        <label>Zip Code:
                            <input type="number" name="zip" id="zip" placeholder="Zip Code">
                        </label>
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 columns medium-centered">
                    <center>
                        <input class="button" name="signIn" type="submit" value="Register Account">
                    </center>
                </div>
            </div>
        </form>
        <br>
        <div class="row">
            <div class="medium-6 columns medium-centered">
                <center>
                    <a class="button" href="https://www.anderskitchen.com/login.php">Already have an account? Click Here to sign in.</a>
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
