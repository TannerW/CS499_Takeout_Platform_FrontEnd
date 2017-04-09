<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getPricePerServing($baseURLid){
    
//    $url = "https://spoonacular.com/".$baseURLid;
//    $content = file_get_contents($url);
//    $first_step = explode( '<div class="spoonacularPriceBreakdownTable">' , $content );
//    $second_step = explode('<div class="spoonacular-quickview">' , $first_step[1] );
//    $third_step = explode("</div>" , $second_step[1] );
//
//    $pricePerServing = $first_step;
    
    $doc = new DomDocument();
    $doc->loadHTMLFile("https://spoonacular.com/".$baseURLid);
    $thediv = $doc->getElementByClass('spoonacularPriceBreakdownTable');
    $pricePerServing=$thediv->textContent;
    
    return $pricePerServing;
}

?>