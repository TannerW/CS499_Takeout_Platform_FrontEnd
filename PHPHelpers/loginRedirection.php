        <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        include('/var/html/www/PHPHelpers/getMyProfileButton.php');
        
        //$string = getMyProfileButton();

        $permission = "admin"; //$string['abilities'];
        
        
        $webpage = "/login.php";
        $owner = "/ownerPortal.php";
        $customer = "/customerPortal.php";
        $driver = "/driverPortal.php";
        $login = "/login.php";
        
        switch ($permission){
            case "admin":
                $webpage = $owner;
                break;
            case "chef":
                $webpage = $owner;
                break;
            case "driver":
                $webpage = $driver;
                break;
            case "customer":
                $webpage = $customer;
                break;
            default:
                $webpage = $login;
                break;
        }
        
    header("Location: https://www.anderskitchen.com/ownerPortal.php"); /* Redirect browser */
    exit();

?>
