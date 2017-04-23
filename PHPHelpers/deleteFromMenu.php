<html>
    <head>
        <title>Ander's Kitchen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/foundation.css" /> <!--foundation styles-->

    </head>

    <body>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//--------------ACQUIRE TOKEN---------------
    require_once'./httpful.phar';

    $cookie_name = "token"; //JWT token

    if (!isset($_COOKIE[$cookie_name])) {
        return "False";
    } else {
        //----------send token, delete recipe---------
        $requesturl = 'https://www.anderskitchen.com/api/menu?"date"="'+$_POST["mealDate"]+'"'; //request url
        

        $dateToDelete = $_POST["mealDate"];

        $auth = 'JWT ' . $_COOKIE[$cookie_name];
        $response = \Httpful\Request::delete($requesturl)->addHeader('Authorization', $auth)->send();
        
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