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
    </head>

    <body>
<div class="spoonacular-search">
                      	<form>  
                            <input type="text" name="type" id="type">Type</input>
                            <input type="text" name="query" id="query">Query</input>
                            <input type="text" name="cuisine" id="cuisine">Cuisine</input>
                            <input type="text" name="diet" id="diet">Diet</input>
                            <input class="button" type="submit" name="submitSpoonacularQuery" value="send"></input>
                      	</form>
                        </div>
                        
<div class="spoonacular-results">
     <?php
                           include 'spoonacularRecipeQuery.php';
                            if( isset($_GET['submitSpoonacularQuery']) )
                            {
                            //be sure to validate and clean your variables
                            $type = htmlentities($_GET['type']);
                            $query = htmlentities($_GET['query']);
                            $cuisine = htmlentities($_GET['cuisine']);
                            $diet = htmlentities($_GET['diet']);

                            //then you can use them in a PHP function. 
                            $result = spoonacularRecipeQuery($type, $query,$cuisine,$diet);
                            }?>
                            

                            <?php if( isset($result) ){echo $result;
}
                                ?> 
                        </div>
        <script type="text/javascript" src="js/vendor/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/foundation.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script> <!---My custom jscript and jquery--->
        <script type="text/javascript">
            $(document).foundation();
        </script>
    </body>
</html>
