<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Ander's Kitchen | Owner's Portal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/foundation.css" /> <!--foundation styles-->
        <link rel="stylesheet" href="css/ownerPortal.css" />
        <link rel="stylesheet" href="css/foundation-datepicker.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" />
        <link href="https://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">

        <?php
        require_once './httpful.phar';
        include 'PHPHelpers/permissionPolicer.php';
        $permission = permissionPolicer();
        ?>
    </head>

    <body>
        <?php
        if ($permission == "False") {
            ?>
            You Really Shouldn't Be Here.. go to: https://www.anderskitchen.com/login.php to log in.
            <?php
        } else {
            ?>
            <div class="spoonacular-search">
                <form>  
                    <label>Type
                        <input type="text" name="type" id="type">
                    </label>
                    <p class="help-text" id="typeHelpText">The type of the recipes. One of the following: main course, side dish, dessert, appetizer, salad, bread, breakfast, soup, beverage, sauce, or drink.</p>
                    <label>Query
                        <input type="text" name="query" id="query">
                    </label>
                    <p class="help-text" id="queryHelpText">The one keyword for recipe search query. (i.e. burger, salad, casserole, pie, paste, etc.)</p>
                    <label>Cuisine
                        <input type="text" name="cuisine" id="cuisine">
                    </label>
                    <p class="help-text" id="cuisineHelpText">The cuisine(s) of the recipes. One or more (comma separated) of the following: african, chinese, japanese, korean, vietnamese, thai, indian, british, irish, french, italian, mexican, spanish, middle eastern, jewish, american, cajun, southern, greek, german, nordic, eastern european, caribbean, or latin american.</p>
                    <label>Diet
                        <input type="text" name="diet" id="diet">
                    </label>
                    <p class="help-text" id="dietHelpText">The diet to which the recipes must be compliant. Possible values are: pescetarian, lacto vegetarian, ovo vegetarian, vegan, paleo, primal, and vegetarian.</p>
                    <input class="button" type="submit" name="submitSpoonacularQuery" value="send"></input>
                </form>
            </div>

            <div class="spoonacular-results">
                <?php
                include 'spoonacularRecipeQuery.php';
                if (isset($_GET['submitSpoonacularQuery'])) {
                    //be sure to validate and clean your variables
                    $type = htmlentities($_GET['type']);
                    $query = htmlentities($_GET['query']);
                    $cuisine = htmlentities($_GET['cuisine']);
                    $diet = htmlentities($_GET['diet']);

                    //then you can use them in a PHP function. 
                    $result = spoonacularRecipeQuery($type, $query, $cuisine, $diet);
                }
                ?>


                <?php
                if (isset($result)) {
                    echo $result;
                }
                ?> 
            </div>
<?php } ?>

        <script type="text/javascript" src="js/vendor/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/foundation.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script> <!---My custom jscript and jquery--->
        <script type="text/javascript">
            $(document).foundation();
        </script>
    </body>
</html>
