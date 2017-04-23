<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
       * 
       * acquire all orders
       *
       * @param none
       * @return formatted html to present all the users in a spreadsheet style
       */

function getAllOrders() {
    //--------------ACQUIRE TOKEN---------------
    require_once './httpful.phar';

    $cookie_name = "token";
        $url = "https://www.anderskitchen.com/api/order";
        $headers = array('Content-Type' => 'application/json', 'Authorization' => 'JWT ' . $_COOKIE[$cookie_name]);

        //var_dump($headers);
        //$result .= $headers;

        $auth = 'JWT ' . $_COOKIE[$cookie_name];

        //----------send token, ask for users---------
        $response = \Httpful\Request::get($url)->addHeader('Authorization', $auth)->send();
        //$response = Unirest\Request::get("https://www.anderskitchen.com/api/me", array("Authorization" => "JWT " . $_COOKIE[$cookie_name]));
        //$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/search?diet=&type=&query=salad&", array(
        //            "X-Mashape-Key" => "cZ62r6rrpamshV3fklErWwfvvQjRp1hmV8wjsnnXRmd5Kn8Aao",
        //            "Accept" => "application/json"
        //                )
        //);
        
        //------------PARSE RESPONSE--------------

        $result .= $response;

        $string = json_decode($result, true);
        
        $index=0; //index number of users
        
        //construct spreadsheet header
        $parsed .= '<div class="row full customerEntry" style="background-color: lightgrey">
                                <div class="medium-1 column">Entry ID</div>
                                <div class="medium-2 column">Delivery/Pick-up</div>
                                <div class="medium-1 column">Cost/qty</div>
                                <div class="medium-1 column">User</div>
                                <div class="medium-2 column">Submission Date</div>
                                <div class="medium-3 column">Quantity</div>
                                <div class="medium-1 column">Payment Method</div>
                                <div class="medium-1 column">Order ID</div>
                            </div>';
        
        //$test ="";
        
        foreach ($string["orders"] as $i) {
       
            $orderID = $i["id"];
            $orderUser = $i["user_id"];
            $orderDate = substr($i["created_at"],0,10);
            $orderDetails = $i["OrderDetails"];
            
            $UserInfoResponse = \Httpful\Request::get("https://www.anderskitchen.com/api/user/".$orderUser)->addHeader('Authorization', $auth)->send();
            $UserInfo = json_decode($UserInfoResponse, true);
            $userName = $UserInfo["Profiles"][0]["first_name"]." ". $UserInfo["Profiles"][0]["last_name"];
            //$test = $test.$i[updated_at].var_dump($orderDetails);
            //$test = $test."<br><br>";
            
            foreach ($orderDetails as $orderEntry){
            $index = $index + 1;
            //choose a row color to ease viewing
            if ($index%2 == 0){
            $backgroundColor = 'style="background-color: lightgrey"';
            } else {
                $backgroundColor ='';
            }
            
            //construct row for current user
            $parsed .= '<div class="row full customerEntry"' . $backgroundColor . '>
                                <div class="medium-1 column">'.$orderEntry["id"].'</div>
                                <div class="medium-2 column">'.$orderEntry["status"].'</div>
                                <div class="medium-1 column">'.$orderEntry["cost"].'</div>
                                <div class="medium-1 column">'.$userName.'</div>
                                <div class="medium-2 column">'.$orderDate.'</div>
                                <div class="medium-3 column">'.$orderEntry["quantity"].'</div>
                                <div class="medium-1 column">'.$orderEntry["payment_method"].'</div>
                                <div class="medium-1 column">'.$orderID.'</div>
                            </div>';
            //$parsed .= $i["email"];
            }
        }
        

        return $parsed;
    }

?>