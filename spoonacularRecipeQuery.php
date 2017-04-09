<?php

function spoonacularRecipeQuery($type, $query, $cuisine, $diet) {


    require_once '/var/www/html/unirest/vendor/mashape/unirest-php/src/Unirest.php';



    $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/search?diet=$diet&type=$type&query=$query&cuisine=$cuisine&number=100&offset=0", array(
                "X-Mashape-Key" => "cZ62r6rrpamshV3fklErWwfvvQjRp1hmV8wjsnnXRmd5Kn8Aao",
                "Accept" => "application/json"
                    )
    );

    $results.='<div class="row small-up-1 medium-up-2 large-up-2">';

    foreach ($response->body->results as $i) {
        $baseURLid = substr($i->image, 0, -4); //the website indexing id for the recipe

        $results.='<div class="column">
        <div class="card">
        <center><img src="https://spoonacular.com/recipeImages/' . $i->image . '" height="400" width="400"></center>
        <div class="card-section">
          <h2 class="panel"><a href="https://spoonacular.com/' . $baseURLid . '" target="_blank" title="' . $i->title . '">' . $i->title . '</a></h2>
          <p><h4>Recipe ID:</h4>' . $i->id . '</p>
          <a class="button custButton" href="https://spoonacular.com/' . $baseURLid . '" target="_blank">Read More</a>
          <p><a class="button" name="addToTheMenu" data-open="exampleModal'.$i->id.'">Add to the menu</a></p>
          <div class="reveal" id="exampleModal'.$i->id.'" data-reveal>
                    <iframe style="width: 100%; height:500px;" src="schedulingHelper.php?recipe_id='.$i->id.'&recipeName='.$i->title.'&recipeURL=https://spoonacular.com/'.$baseURLid.'&pictureURL=https://spoonacular.com/recipeImages/' . $i->image . '"></iframe>
                    <button class="close-button" data-close aria-label="Close reveal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
           </div>
        </div>
      </div>
    </div>';
    }

    $results .='</div>';

    return $results;
    
    //<form action="https://www.anderskitchen.com/PHPHelpers/addToMenu?id=' . $i->id . '" method="post">
     //      <input class="button" name="addToTheMenu" type="submit" value="Add to the menu">
     //     </form>
    //<p><a class="button" name="addToTheMenu" data-open="exampleModal2">Add to the menu</a></p>
    
//    <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]) .'?id=' . $i->id . '" method="post">
//            <input class="button" name="addToTheMenu" type="submit" data-open="exampleModal'.$i->id.'" value="Add to the menu">
//          </form>
}

?>
