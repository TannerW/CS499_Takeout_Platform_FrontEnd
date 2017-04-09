<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getAllUsers() {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    require_once './httpful.phar';

    $cookie_name = "token";
        $url = "https://www.anderskitchen.com/api/user";
        $headers = array('Content-Type' => 'application/json', 'Authorization' => 'JWT ' . $_COOKIE[$cookie_name]);

        //var_dump($headers);
        //$result .= $headers;

        $auth = 'JWT ' . $_COOKIE[$cookie_name];

        $response = \Httpful\Request::get($url)->addHeader('Authorization', $auth)->send();
        //$response = Unirest\Request::get("https://www.anderskitchen.com/api/me", array("Authorization" => "JWT " . $_COOKIE[$cookie_name]));
        //$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/search?diet=&type=&query=salad&", array(
        //            "X-Mashape-Key" => "cZ62r6rrpamshV3fklErWwfvvQjRp1hmV8wjsnnXRmd5Kn8Aao",
        //            "Accept" => "application/json"
        //                )
        //);

        $result .= $response;

        $string = json_decode($result, true);
        
        $index=0; //index number of users
        
        $parsed .= '<div class="row full customerEntry" style="background-color: lightgrey">
                                <div class="medium-1 column">User ID</div>
                                <div class="medium-2 column">Name</div>
                                <div class="medium-4 column">Address</div>
                                <div class="medium-3 column"></div>
                                <div class="medium-1 column"></div>
                                <div class="medium-1 column"></div>
                            </div>';
        
        foreach ($string["users"] as $i) {
            $index = $index + 1;
            $userID = $i["id"]; //get user id
            
            //request uder info
            $userQueryURL = "https://www.anderskitchen.com/api/user/" . $userID;
            $userQuery = \Httpful\Request::get($userQueryURL)->addHeader('Authorization', $auth)->send();
            $user = json_decode($userQuery, true);
            
            $userProfile=$user["profile"]; //get profile from json
            
            //choose a row color to ease viewing
            if ($index%2 == 0){
            $backgroundColor = 'style="background-color: lightgrey"';
            } else {
                $backgroundColor ='';
            }
            
            $parsed .= '<div class="row full customerEntry"' . $backgroundColor . '>
                                <div class="medium-1 column">'.$userID.'</div>
                                <div class="medium-2 column">'.$userProfile["first_name"].$userProfile["last_name"].'</div>
                                <div class="medium-4 column">'.$userProfile["street_1"].'</div>
                                <div class="medium-3 column"></div>
                                <div class="medium-1 column"></div>
                                <div class="medium-1 column"></div>
                            </div>';
            //$parsed .= $i["email"];
            
        }
        

        return $parsed;
    }

?>