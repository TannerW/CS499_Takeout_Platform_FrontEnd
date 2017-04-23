<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
/**
       * 
       * recipe scheduling assistant page
       *
       */

       ?>
<html>
    <head>
        <title>Ander's Kitchen | Scheduling Helper</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/foundation.css" /> <!--foundation styles-->
        <link rel="stylesheet" href="css/ownerPortal.css" />
        <link rel="stylesheet" href="css/foundation-datepicker.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" />
        <link href="https://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    </head>

    <body>
<?php
//--------------ACQUIRE TOKEN---------------
    require_once'./httpful.phar';

    $cookie_name = "token"; //JWT token

    if (!isset($_COOKIE[$cookie_name])) {
        return "False";
    } else {
        //----------send token, post recipe data---------
        $requesturl = "https://www.anderskitchen.com/api/menu"; //request url
        
        $data = array(
                'date' => "",
                'recipe_id' => $_POST["recipe_id"],
                'misc' => json_encode(array(
                    'recipe_name' => $_POST["recipeName"],
                    'picture_url' => $_POST["pictureURL"],
                    'recipe_url' => $_POST["recipeURL"],
                    'cost_per_serving' => $_POST["costPerServing"],
                    'sale_price_per_serving' => $_POST["salePricePerServing"]
                )),
            );

            var_dump($data);
        $auth = 'JWT ' . $_COOKIE[$cookie_name];
        $response = \Httpful\Request::post($requesturl)->addHeader('Authorization', $auth)->sendsJson()->body($data)->send();
        $result .= $response;
        $string = json_decode($result, true);
        
        //dump page response for debugging
        var_dump($string);
    }

?>
    <script type="text/javascript" src="js/vendor/jquery.js"></script>
    <script type="text/javascript" src="js/vendor/foundation.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script> <!---My custom jscript and jquery--->
    <script type="text/javascript" src="js/foundation-datepicker.js"></script>
    <script type="text/javascript">
        $(document).foundation();
    </script>
</body>
</html>