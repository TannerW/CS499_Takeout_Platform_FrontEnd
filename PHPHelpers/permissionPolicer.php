<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function permissionPolicer() {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    require_once'./httpful.phar';

    $cookie_name = "token"; //JWT token

    if (!isset($_COOKIE[$cookie_name])) {
        return "False";
    } else {
        $currLocation = $_SERVER['REQUEST_URI']; //current url

        echo $currLocation;

        $requesturl = "https://www.anderskitchen.com:9000/me"; //request url

        $auth = 'JWT ' . $_COOKIE[$cookie_name];
        $response = \Httpful\Request::get($requesturl)->addHeader('Authorization', $auth)->send();
        $result .= $response;
        $string = json_decode($result, true);

        $permission = $string['abilities'];

        $allowedToBeHere = "False";

        $owner = "/ownerPortal.php";
        $ownerSelect = "/adminPortalSelect.php";
        $customer = "/customerPortal.php";
        $index = "/index.php";
        $login = "/login.php";

        switch ($permission) {
            case "admin":
                $allowedToBeHere = "TrueAdmin";
                break;
            case "chef":
                if ($currLocation === $owner) {
                    $allowedToBeHere = "Restricted";
                } else {
                    $allowedToBeHere = "True";
                }
                break;
            case "driver":
                if ($currLocation === ($owner || $ownerSelect)) {
                    $allowedToBeHere = "False";
                } else {
                    $allowedToBeHere = "True";
                }
                break;
            case "customer":
                if ($currLocation === ($customer || $login || $index)) {
                    $allowedToBeHere = "TrueCustomer";
                } else {
                    $allowedToBeHere = "False";
                }
                break;
            default:
                if ($currLocation === ($customer || $login || $index)) {
                    $allowedToBeHere = "TrueDefault";
                } else {
                    $allowedToBeHere = "False";
                }
                break;
        }

        return $allowedToBeHere;
    }
}

?>