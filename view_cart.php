<?php
session_start();
include "config.php";
require_once './httpful.phar';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>View shopping cart</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <?php
        $cookie_name = "token";
        include 'PHPHelpers/getMyProfileButton.php';
        $result = getMyProfileButton();
        ?>
    </head>
    <body>

        <?php
        if ($result == "No token") {
            ?>
            You Really Shouldn't Be Here.. go to: https://www.anderskitchen.com/login.php to log in.
        <?php } else {
            ?>

            <h1 align="center">View Cart</h1>
            <div class="cart-view-table-back">
                <form method="post" action="cart_update.php">
                    <table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Quantity</th><th>Name</th><th>Price</th><th>Total</th><th>pick up/delivery</th><th>Remove</th></tr></thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION["cart_products"])) { //check session var
                                $total = 0; //set initial total value
                                $shipping_cost_total = 0;
                                $b = 0; //var for zebra stripe table 
                                foreach ($_SESSION["cart_products"] as $cart_itm) {
                                    //set variables to use in content below
                                    $product_name = $cart_itm["recipe_name"];
                                    $product_qty = $cart_itm["product_qty"];
                                    $product_price = $cart_itm["sale_price_per_serving"];
                                    $product_code = $cart_itm["recipe_id"];
                                    $product_option = $cart_itm["product_option"];
                                    $subtotal = ($product_price * $product_qty); //calculate Price x Qty

                                    $bg_color = ($b++ % 2 == 1) ? 'odd' : 'even'; //class for zebra stripe 
                                    echo '<tr class="' . $bg_color . '">';
                                    echo '<td><input type="text" size="3" maxlength="3" name="product_qty[' . $product_code . ']" value="' . $product_qty . '" /></td>';
                                    echo '<td>' . $product_name . '</td>';
                                    echo '<td>' . $currency . $product_price . '</td>';
                                    echo '<td>' . $currency . $subtotal . '</td>';
                                    echo '<td>' . $product_option . '</td>';
                                    echo '<td><input type="checkbox" name="remove_code[]" value="' . $product_code . '" /></td>';
                                    echo '</tr>';
                                    $total = ($total + $subtotal); //add subtotal to total var
                                    $option_string_parse = substr($product_option, 0, 4); //getting first 4 letters of option to check which option it is
                                    if ($option_string_parse === "deli") {
                                        $shipping_cost_total = ($shipping_cost_total + $shipping_cost);
                                    }
                                }

                                $grand_total = $total + $shipping_cost_total; //grand total including shipping cost
                                foreach ($taxes as $key => $value) { //list and calculate all taxes in array
                                    $tax_amount = round($total * ($value / 100));
                                    $tax_item[$key] = $tax_amount;
                                    $grand_total = $grand_total + $tax_amount;  //add tax val to grand total
                                }

                                $list_tax = '';
                                foreach ($tax_item as $key => $value) { //List all taxes
                                    $list_tax .= $key . ' : ' . $currency . sprintf("%01.2f", $value) . '<br />';
                                }
                                $shipping_cost_text = ($shipping_cost_total) ? 'Delivery Cost : ' . $currency . sprintf("%01.2f", $shipping_cost_total) . '<br />' : '';
                            }
                            ?>
                            <tr><td colspan="5">
                                    <span style="float:right;text-align: right;">
                                        <?php echo $shipping_cost_text . $list_tax; ?>Amount Payable : <?php echo sprintf("%01.2f", $grand_total); ?>
                                    </span></td></tr>
                            <tr><td colspan="5">
                                    <a href="https://www.anderskitchen.com/customerPortal.php" class="button">Add More Items</a>
                                    <button type="submit">Update</button>
                                    <div id="paypal-button-container"></div>
                                    <div id="confirm" style="display: none;">
                                        <div>Deliveries, if selected, will be sent to:</div>
                                        <div><span id="recipient"></span>, <span id="line1"></span>, <span id="city"></span></div>
                                        <div><span id="state"></span>, <span id="zip"></span>, <span id="country"></span></div>

                                        <button id="confirmButton">Complete Payment</button>
                                    </div>

                                    <div id="thanks" style="display: none;">
                                        Thanks, <span id="thanksname"></span>!
                                    </div>
                                    </td></tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="return_url" value="<?php
                    $current_url = urlencode($url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                    echo $current_url;
                    ?>" />
                </form>
            </div>
        <?php } ?>
    </body>
    <script src="js/vendor/jquery.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/submitOrder.js"></script>
    <script>
        paypal.Button.render({
            env: 'sandbox', // Optional: specify 'sandbox' environment

            client: {
                sandbox: 'AdmSa7vnmGPgnp47TmPAlnQnKnGB-T16fd_En5mXYitRPjoX6VkJ4Ru9s5DHHu4FA36em1WE6EPoeTyt',
                production: 'xxxxxxxxx'
            },
            payment: function () {

                var env = this.props.env;
                var client = this.props.client;

                return paypal.rest.payment.create(env, client, {
                    "transactions": [
                        {
                            "amount": {
                                "total": "<?php echo $grand_total; ?>",
                                "currency": "USD",
                                "details": {
                                    "subtotal": "<?php echo $total; ?>",
                                    //"tax": "0.07",
                                    "shipping": "<?php echo $shipping_cost_total ?>",
                                    //"handling_fee": "1.00",
                                    //"shipping_discount": "-1.00",
                                    //"insurance": "0.01"
                                }
                            },
                            "description": "The payment transaction description.",
                            "item_list": {
                                "items": [
<?php
foreach ($_SESSION["cart_products"] as $cart_itm) {
    //set variables to use in content below
    $product_name = $cart_itm["recipe_name"];
    $product_qty = $cart_itm["product_qty"];
    $product_price = $cart_itm["sale_price_per_serving"];
    ?>
                                        {
                                            "name": "<?php echo $product_name; ?>",
                                            "quantity": "<?php echo $product_qty; ?>",
                                            "price": "<?php echo $product_price; ?>",
                                            "currency": "USD"
                                        },
<?php } ?>
                                ],
                                "shipping_address": {
                                    "recipient_name": "<?php echo $result["Profiles"][0]["first_name"];
echo $result["Profiles"][0]["last_name"];
?>",
                                    "line1": "<?php echo $result["Profiles"][0]["street_1"]; ?>",
                                    "line2": "<?php echo $result["Profiles"][0]["street_2"]; ?>",
                                    "city": "<?php echo $result["Profiles"][0]["city"]; ?>",
                                    "country_code": "US",
                                    "postal_code": "<?php echo $result["Profiles"][0]["zip_code"]; ?>",
                                    "phone": "<?php echo $result["Profiles"][0]["phone"]; ?>",
                                    "state": "<?php echo $result["Profiles"][0]["state"]; ?>"
                                }
                            }
                        }
                    ],
                });
            },
            onAuthorize: function (data, actions) {
                // Execute the payment here, when the buyer approves the transaction
                return actions.payment.get().then(function (data) {

                    // Display the payment details and a confirmation button

                    var shipping = data.payer.payer_info.shipping_address;

                    document.querySelector('#recipient').innerText = shipping.recipient_name;
                    document.querySelector('#line1').innerText = shipping.line1;
                    document.querySelector('#city').innerText = shipping.city;
                    document.querySelector('#state').innerText = shipping.state;
                    document.querySelector('#zip').innerText = shipping.postal_code;
                    document.querySelector('#country').innerText = shipping.country_code;

                    document.querySelector('#paypal-button-container').style.display = 'none';
                    document.querySelector('#confirm').style.display = 'block';

                    // Listen for click on confirm button

                    document.querySelector('#confirmButton').addEventListener('click', function () {

                        // Disable the button and show a loading message

                        document.querySelector('#confirm').innerText = 'Loading...';
                        document.querySelector('#confirm').disabled = true;

                        // Execute the payment

                        return actions.payment.execute().then(function () {
                            // Show a success page to the buyer
                            
                            // Show a thank-you note

                            document.querySelector('#thanksname').innerText = shipping.recipient_name;

                            document.querySelector('#confirm').style.display = 'none';
                            document.querySelector('#thanks').style.display = 'block';
                        
                                    <?php
            //build order submission JSON
            $order = array(
                'orderDetails' => array(
                )
            );

            foreach ($_SESSION["cart_products"] as $cart_itm) {
                //set variables to use in content below
                $product_name = $cart_itm["recipe_name"];
                $product_qty = $cart_itm["product_qty"];
                $product_price = $cart_itm["sale_price_per_serving"];
                $product_option = $cart_itm["product_option"];
                $menu_id = $cart_itm["menu_id"];
                $order_method = '';

                $option_string_parse = substr($product_option, 0, 4); //getting first 4 letters of option to check which option it is
                if ($option_string_parse === "deli") {
                    $order_method = "delivery";
                } else {
                    $order_method = "pick-up";
                }

                $currOrderEntry = array(
                    'status' => $order_method,
                    'cost' => floatval($product_price),
                    'payment_method' => 'TEST',
                    'qunatity' => intval($product_qty),
                    'menu_id' => $menu_id
                );

                array_push($order['orderDetails'], $currOrderEntry);       
            }

            $js_array = json_encode($order);
            echo "var order_array = " . $js_array . ";\n";
            ?>
                                    
                            console.log(data);
                            console.log(data.id);
                            console.log("Order Successful");
                            console.log(<?php echo $_SESSION["cart_products"] ?>);
                            
    $.ajax({
                    type: "POST",
                    url: "/PHPHelpers/submitOrder.php",
                    data: {data: JSON.stringify(order_array)},
                    dataType: "json",
                    success: function (data) {
                        alert(data);
                        status = "success";
                        }
                    });
                            //var status = submitOrder(order_array, data.id);
                            console.log(status);
                        });
                    });
                });
            }

        }, '#paypal-button-container');
    </script>
</html>
