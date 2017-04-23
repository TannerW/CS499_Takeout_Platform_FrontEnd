<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
       * 
       * gets this weeks menu and returns it in a presentable structure
       *
       * @param baseURLid - string - the url of the recipe page that you'd like to find the cost per serving of
       * @return the cost per serving as a string
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
        
        //var_dump($string);
        $mon = $tue = $wed = $thu = $fri = "";
        
        $index = 0;
        $menu.='<div class="row full small-up-1 medium-up-2 large-up-3">';
        
        foreach ($string["meals"] as $mealsProfile) {
            $index = $index + 1;
            $currentDayEntry="";
            
            $timestamp = strtotime($mealsProfile['meal_date']);

            $day = date('D', $timestamp);
            $mealsID = $mealsProfile["recipe_id"]; //get meal id
            
            $miscField = json_decode($mealsProfile['misc']);
            
            //var_dump($miscField);
            
            $currentDayEntry='<div class="column">
                    <div class="card">
                    <center><h2>'.$day.'</h2></center>
                    <center><h4>'.substr($mealsProfile['meal_date'],0,10).'</h4></center>
                    <center><img src="' . $miscField->{'picture_url'} . '" height="350px" width="350px"></center>
                    <div class="card-section">
                            <h3 class="panel"><a href="' . $miscField->{'recipe_url'} . '" target="_blank" title="' . $miscField->{'recipe_name'} . '">' . $miscField->{'recipe_name'} . '</a></h3>
                            <p><h4>Recipe ID:</h4>' . $mealsID . '</p>
                             <p><h4>Cost per Serving</h4>' . $miscField->{'cost_per_serving'} . '</p>
                             <p><h4>Sale price per Serving</h4>' . $miscField->{'sale_price_per_serving'} . '</p>
                             <form id="deleteFromMenu" method="post">
                            <center>
                                <input type="hidden" name="mealDate" id="mealDate" value="'.substr($mealsProfile['meal_date'],0,10).'">
                                <input class="button" name="deleteFromMenu" type="submit" value="Unschedule">
                            </center>
            </form>
                    </div>
                    </div>
                    </div>';
            //$parsed .= $i["email"];
            
            switch($day){
                case "Mon":
                    $mon=$currentDayEntry;
                    break;
                case "Tue":
                    $tue=$currentDayEntry;
                    break;
                case "Wed":
                    $wed=$currentDayEntry;
                    break;
                case "Thu":
                    $thu=$currentDayEntry;
                    break;
                case "Fri":
                    $fri=$currentDayEntry;
                    break;
                default:
                    //should never happen. something is broken if youre found here
                    break;
            }
        }
        $menu .=$mon.$tue.$wed.$thu.$fri.'</div>';
        return $menu;
    }
}

?>