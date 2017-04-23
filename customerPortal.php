<?php
session_start();


//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Ander's Kitchen | Hello valued customer!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!---foundation styles--->
        <link rel="stylesheet" href="css/foundation.css" />

        <link rel="stylesheet" type="text/css" href="css/customerPortal.css"/> <!---my custom styles--->
        <link rel="stylesheet" type="text/css" href="css/masterStyles.css"/><!---my custom styles--->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" />

        <script src="js/vendor/modernizr.js"></script>
    </head>
    <body>
        <?php
        if ($permission == "False") {
            ?>
            You Really Shouldn't Be Here.. go to: https://www.anderskitchen.com/login.php to log in.
            <?php
        } else {
            ?>
            
<h1 align="center">Products </h1>

<!-- View Cart Box Start -->
<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
	echo '<div class="cart-view-table-front" id="view-cart">';
	echo '<h3>Your Shopping Cart</h3>';
	echo '<form method="post" action="cart_update.php">';
	echo '<table width="100%"  cellpadding="6" cellspacing="0">';
	echo '<tbody>';

	$total =0;
	$b = 0;
	foreach ($_SESSION["cart_products"] as $cart_itm)
	{
		$product_name = $cart_itm["recipe_name"];
		$product_qty = $cart_itm["product_qty"];
		$product_price = $cart_itm["sale_price_per_serving"];
		$product_code = $cart_itm["recipe_id"];
		$product_option = $cart_itm["product_option"];
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
		echo '<tr class="'.$bg_color.'">';
		echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
		echo '<td>'.$product_name.'</td>';
		echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
		echo '</tr>';
		$subtotal = ($product_price * $product_qty);
		$total = ($total + $subtotal);
	}
	echo '<td colspan="4">';
	echo '<button type="submit" class="button">Update</button><br><a href="view_cart.php" class="button">Checkout</a>';
	echo '</td>';
	echo '</tbody>';
	echo '</table>';
	
	$current_url = urlencode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
	echo '</form>';
	echo '</div>';

}
?>
<!-- View Cart Box End -->


<!-- Products List Start -->
<?php
require_once 'PHPHelpers/presentMenuToUser.php';
$menu=presentMenuToUser($current_url);
echo $menu;
//$results = $mysqli->query("SELECT product_code, product_name, product_desc, product_img_name, price FROM products ORDER BY id ASC");
//if($results){ 
//$products_item = '<ul class="products">';
////fetch results set as object and output HTML
//while($obj = $results->fetch_object())
//{
//$products_item .= <<<EOT
//	<li class="product">
//	<form method="post" action="cart_update.php">
//	<div class="product-content"><h3>{$obj->product_name}</h3>
//	<div class="product-thumb"><img src="images/{$obj->product_img_name}"></div>
//	<div class="product-desc">{$obj->product_desc}</div>
//	<div class="product-info">
//	Price {$currency}{$obj->price} 
//	
//	<fieldset>
//	
//	<label>
//		<span>Color</span>
//		<select name="product_color">
//		<option value="Black">Black</option>
//		<option value="Silver">Silver</option>
//		</select>
//	</label>
//	
//	<label>
//		<span>Quantity</span>
//		<input type="text" size="2" maxlength="2" name="product_qty" value="1" />
//	</label>
//	
//	</fieldset>
//	<input type="hidden" name="product_code" value="{$obj->product_code}" />
//	<input type="hidden" name="type" value="add" />
//	<input type="hidden" name="return_url" value="{$current_url}" />
//	<div align="center"><button type="submit" class="add_to_cart">Add</button></div>
//	</div></div>
//	</form>
//	</li>
//EOT;
//}
//$products_item .= '</ul>';
//echo $products_item;
//}
?>    
<!-- Products List End -->
        <?php } ?>
    </body>
</html>
