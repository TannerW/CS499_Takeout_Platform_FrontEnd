<?php

function getMyProfileButton() {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    include('./httpful.phar');

    $cookie_name = "token";
    if (!isset($_COOKIE[$cookie_name])) {
        echo "No token";
    } else {
        $url = "https://www.anderskitchen.com:9000/me";
        $headers = array('Content-Type' => 'application/json', 'Authorization' => 'JWT ' . $_COOKIE[$cookie_name]);

        //var_dump($headers);
        //$result .= $headers;

        $auth = 'JWT ' . $_COOKIE[$cookie_name];

        $response = \Httpful\Request::get($url)->addHeader('Authorization', $auth)->send();
        //$response = Unirest\Request::get("https://www.anderskitchen.com:9000/me", array("Authorization" => "JWT " . $_COOKIE[$cookie_name]));
        //$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/search?diet=&type=&query=salad&", array(
        //            "X-Mashape-Key" => "cZ62r6rrpamshV3fklErWwfvvQjRp1hmV8wjsnnXRmd5Kn8Aao",
        //            "Accept" => "application/json"
        //                )
        //);

        $result .= $response;
        
        
        echo $currLocation;

        $string = json_decode($result, true);

        return $string;
    }
}

?>