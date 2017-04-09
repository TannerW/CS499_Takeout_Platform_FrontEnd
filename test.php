<!doctype html>
<html class="no-js" lang="en">
    <body>
        <div>My Name is tanner</div>
        <?php
        echo "Hello.";

        require_once '/var/www/html/unirest/vendor/mashape/unirest-php/src/Unirest.php';

        echo "Hello.";

        $query = array('email' => 'atest@atest.com', 'password' => 'atestpassword');
        $headers = array('Content-Type' => 'application/json');

        $body = Unirest\Request\Body::json($query);
        echo $body;

        $response = Unirest\Request::post('https://www.anderskitchen.com/api/session', $headers, $body);
        $result = count($response->body);
        echo $result;

        echo $response->body->token;
        echo "\n";

        $headers = array('Authorization' => 'JWT ' . $response->body->token);


        $response = Unirest\Request::get('https://www.anderskitchen.com/api/user', $headers);

        $result = count($response->body);
        echo $result;
        echo $response->raw_body;

        $response = Unirest\Request::get('https://www.anderskitchen.com/api/user/2', $headers);

        $result = count($response->body);
        echo $result;
        echo $response->raw_body;
        ?>
    </body>
</html>
