<html>
    <head>
        <title>Ander's Kitchen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/foundation.css" /> <!--foundation styles-->

    </head>

    <body>
<?php
//--------------ACQUIRE TOKEN---------------
    require_once'./httpful.phar';

    $cookie_name = "token"; //JWT token

    if (!isset($_COOKIE[$cookie_name])) {
        return "False";
    } else {
        //----------send token, post order--------
        $requesturl = "https://www.anderskitchen.com/api/order"; //request url
        $decodedJSON = json_decode($_POST["data"], true);
            
        $test = array(
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
        
        var_dump($decodedJSON);
        var_dump($test);
        $auth = 'JWT ' . $_COOKIE[$cookie_name];
        $response = \Httpful\Request::post($requesturl)->addHeader('Authorization', $auth)->sendsJson()->body($decodedJSON)->send();
        $result .= $response;
        $string = json_decode($result, true);
        
        //dump page response for debugging
        var_dump($string);
    }

?>
    <script type="text/javascript">
        $(document).foundation();
    </script>
</body>
</html>