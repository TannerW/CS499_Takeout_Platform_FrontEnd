<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getMenu(){
    require_once'./httpful.phar';

    $cookie_name = "token"; //JWT token

    if (!isset($_COOKIE[$cookie_name])) {
        return "False";
    } else {
        $requesturl = "https://www.anderskitchen.com/api/menu/this_week"; //request url
        

        $auth = 'JWT ' . $_COOKIE[$cookie_name];
        $response = \Httpful\Request::get($requesturl)->addHeader('Authorization', $auth)->send();
        $result .= $response;
        $string = json_decode($result, true);
        
        var_dump($string);
        
        $parsed .= '<div class="row full customerEntry" style="background-color: lightgrey">
                                <div class="medium-1 column">User ID</div>
                                <div class="medium-2 column">Name</div>
                                <div class="medium-4 column">Address</div>
                                <div class="medium-3 column">Email</div>
                                <div class="medium-1 column"></div>
                                <div class="medium-1 column"></div>
                            </div>';
        
        foreach ($string as $i) {
            $index = $index + 1;
            $mealsID = $i["recipe_id"]; //get user id
            
//            if ($index === 7)
//            {
//                var_dump($user);
//                var_dump($user["Profiles"][0]);
//            }
            
            $mealsProfile=$i; //get profile from json
            
            //choose a row color to ease viewing
            if ($index%2 == 0){
            $backgroundColor = 'style="background-color: lightgrey"';
            } else {
                $backgroundColor ='';
            }
            
            
            $parsed .= '<div class="row full customerEntry"' . $backgroundColor . '>
                                <div class="medium-1 column">'.$mealsID.'</div>
                                <div class="medium-2 column">'.$mealsProfile['meal_date'].'</div>
                                <div class="medium-4 column">'.$mealsProfile['misc'].'</div>
                                <div class="medium-3 column"></div>
                                <div class="medium-1 column"></div>
                                <div class="medium-1 column"></div>
                            </div>';
            //$parsed .= $i["email"];
            
        }
        
        return $parsed;
    }
}

?>