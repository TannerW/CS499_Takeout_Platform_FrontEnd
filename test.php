<!doctype html>

<!-- THIS FILE IS USED FOR TESTING AND IS NOT IMPORTANT TO THE PROJECT -->

<html class="no-js" lang="en">
    <body>
        <div>My Name is tanner</div>
        <?php
//        echo "Hello.";
//
//        require_once '/var/www/html/unirest/vendor/mashape/unirest-php/src/Unirest.php';
//
//        echo "Hello.";
//
//        $query = array('email' => 'atest@atest.com', 'password' => 'atestpassword');
//        $headers = array('Content-Type' => 'application/json');
//
//        $body = Unirest\Request\Body::json($query);
//        echo $body;
//
//        $response = Unirest\Request::post('https://www.anderskitchen.com/api/session', $headers, $body);
//        $result = count($response->body);
//        echo $result;
//
//        echo $response->body->token;
//        echo "\n";
//
//        $headers = array('Authorization' => 'JWT ' . $response->body->token);
//
//
//        $response = Unirest\Request::get('https://www.anderskitchen.com/api/user', $headers);
//
//        $result = count($response->body);
//        echo $result;
//        echo $response->raw_body;
//
//        $response = Unirest\Request::get('https://www.anderskitchen.com/api/user/2', $headers);
//
//        $result = count($response->body);
//        echo $result;
//        echo $response->raw_body;
        
//        $url = 'https://spoonacular.com/Minestrone-Soup-183910';
//$content = file_get_contents($url);
//$first_step = explode( '<div id="wrapper">' , $content );
//$second_step = explode('<div class="column">' , $first_step[0] );
//$third_step = explode('<div class="recipe">' , $second_step[0] );
//$fourth_step = explode('<div class="row">' , $third_step[5] );
//$fifth_step = explode('<div>' , $fourth_step[0] );
//$sixth_step = explode('<div id="spoonacularPriceBreakdownTable">' , $fifth_step[0] );
//$seventh_step = explode('<div class="spoonacular-quickview">' , $sixth_step[0] );
//$eigth_step = explode('</div>' , $seventh_step[0] );
//echo $second_step[1];


$url = "https://spoonacular.com/Minestrone-Soup-183910";
$html = file_get_contents($url);
$string = "Cost per Serving:";
if (strpos($html, $string) !== false) {
    echo substr($html, strpos($html, $string)+strlen($string), 8);
} else {
  echo "Not Found";
}
?>
    </body>
</html>
