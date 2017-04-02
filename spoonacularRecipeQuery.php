<?php
function spoonacularRecipeQuery($type, $query,$cuisine,$diet){


require_once '/var/www/html/unirest/vendor/mashape/unirest-php/src/Unirest.php';



$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/search?diet=$diet&type=$type&query=$query&cuisine=$cuisine",
  array(
    "X-Mashape-Key" => "cZ62r6rrpamshV3fklErWwfvvQjRp1hmV8wjsnnXRmd5Kn8Aao",
    "Accept" => "application/json"
  )
);

foreach($response->body->results as $i)
{
	$results.='<div class="row full">'. $i->id . '<br>' . $i->title . '</div>';
}

return $results;

}
?>
