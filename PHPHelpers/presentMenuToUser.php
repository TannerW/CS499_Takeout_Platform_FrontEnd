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

function presentMenuToUser($currentURL){
    require_once'./httpful.phar';

    $cookie_name = "token"; //JWT token

    if (!isset($_COOKIE[$cookie_name])) {
        return "False";
    } else {
        include "config.php";
        
        $requesturl = "https://www.anderskitchen.com/api/menu/this_week"; //request url
        

        $auth = 'JWT ' . $_COOKIE[$cookie_name];
        $response = \Httpful\Request::get($requesturl)->addHeader('Authorization', $auth)->send();
        $result .= $response;
        $string = json_decode($result, true);
        
        //var_dump($string["meals"]);
        $mon = $tue = $wed = $thu = $fri = "";
        
        $index = 0;
        $menu.='<div class="row full small-up-1 medium-up-2 large-up-3">';
        
        foreach ($string["meals"] as $mealsProfile) {
            $index = $index + 1;
            $currentDayEntry="";
            
            $timestamp = strtotime($mealsProfile['meal_date']);

            $day = date('D', $timestamp);
            $mealsID = $mealsProfile["recipe_id"]; //get meal id
            $menuID = $mealsProfile["id"]; //get menu id
            $miscField = json_decode($mealsProfile['misc']);
            
            //var_dump($miscField);
            
            $currentDayEntry='<div class="column">
                        <div class="card">
                            <center><h2>'.$day.'</h2></center>
                            <center><h4>'.$mealsProfile['meal_date'].'</h4></center>
                            <center><img src="' . $miscField->{'picture_url'} . '" height="350px" width="350px"></center>
                            <div class="card-section">
                                <h3 class="panel"><a href="' . $miscField->{'recipe_url'} . '" target="_blank" title="' . $miscField->{'recipe_name'} . '">' . $miscField->{'recipe_name'} . '</a></h3>
                                <p><h4>Recipe ID:</h4>' . $mealsID . '</p>
                                <p><h4>Cost per Serving</h4>$' . $miscField->{'sale_price_per_serving'} . '.00</p>
                                <form method="post" action="cart_update.php">
                                    <fieldset>

                                    <label>
                                    <span>Quantity</span>
                                    <input type="text" size="2" maxlength="2" name="product_qty" value="1" />
                                    </label>

                                    </fieldset>
                                    <input type="hidden" name="menu_id" value="'.$menuID.'" />
                                    <input type="hidden" name="recipe_id" value="'.$mealsID.'" />
                                    <input type="hidden" name="meal_date" value="'.$mealsProfile['meal_date'].'" />
                                    <input type="hidden" name="recipe_name" value="'.$miscField->{'recipe_name'}.'" />
                                    <input type="hidden" name="sale_price_per_serving" value="'.$miscField->{'sale_price_per_serving'}.'" />
                                    <input type="hidden" name="type" value="add" />
                                    <input type="hidden" name="return_url" value="'.$currentURL.'" />
                                    <div align="center"><button type="submit" class="button add_to_cart" name="pickup_button">Schedule pick up</button></div>
                                    
<br>
                                    <div align="center"><button type="submit" class="button add_to_cart" name="delivery_button">Schedule Delivery (+$5)</button></div>
                                    

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