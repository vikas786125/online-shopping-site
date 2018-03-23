<?php
//establishing connection
$db =mysqli_connect("localhost","root","","myshop");




//function for getting ip address
function getUserIP() {
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}


//getting the defaults for customers

function getDefault(){

		global $db;
		$c = $_SESSION['customer_email'];
		$get_c = "select * from customers where customer_email='$c'";
		$run_c = mysqli_query($db,$get_c);
		$row_c=mysqli_fetch_array($run_c);
			$customer_id = $row_c['customer_id'];

			if(!isset($_GET['my_orders'])){
			if(!isset($_GET['edit_account'])){
			if(!isset($_GET['change_pass'])){
			if(!isset($_GET['delete_account'])){

				$get_orders = "select * from customer_orders where customer_id='$customer_id' AND order_status='pending'";
			    $run_orders = mysqli_query($db,$get_orders);
			    $count_orders = mysqli_num_rows($run_orders);
			    if ($count_orders>0) {
			    	echo "<div style='padding:10px;'>
			    			<h1 style = 'color:red;'>Important</h1>
			    			<h2>You have $count_orders Pending Orders</h2>
			    			<h3>Please see your order details <a href ='my_account.php?my_orders'>here</a></h3>
			    			<h4>Pay offline</h4>

			    	</div>";
			    }
				}
			}
		}
	}
	
}










//getting the products to display
function getPro(){
	             
				  global $db;
			if (!isset($_GET['cat'])) {
			          if (!isset($_GET['brand'])){
			
				$get_products = "select * from products order by rand() LIMIT 0,6";
				$run_products =mysqli_query($db,$get_products);
				
				while($row_products = mysqli_fetch_array($run_products))
				{
					$pro_id = $row_products['product_id'];
			        $pro_title = $row_products['product_title'];
					$pro_cat = $row_products['cat_id'];
					$pro_brand= $row_products['brand_id'];
					$pro_desc = $row_products['product_desc'];
					$pro_price = $row_products['product_price'];
					$pro_image = $row_products['product_img1'];
					
					echo"<div id='single_product'><h3>$pro_title</h3>
					    <img src='admin_area/product_images/$pro_image' width='190' height='190' style='border:2px solid #333;' /><br>
						<p><b>Price:INR $pro_price </b></p>
						<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
						<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
						</div>
						";
				}	
			}
      }
}

//getting category product
function getCatPro(){
	             
				  global $db;
			if (isset($_GET['cat'])) {

			    $cat_id = $_GET['cat'];

			    $get_cat_pro = "select * from products where cat_id='$cat_id'";
				
				$run_cat_pro =mysqli_query($db,$get_cat_pro);

				$count = mysqli_num_rows($run_cat_pro);

				if($count==0){
					echo "<h2>No Products in this Categories</h2>";
				}
				
				while($row_cat_pro = mysqli_fetch_array($run_cat_pro))
				{
					$pro_id = $row_cat_pro['product_id'];
			        $pro_title = $row_cat_pro['product_title'];
					$pro_desc = $row_cat_pro['product_desc'];
					$pro_price = $row_cat_pro['product_price'];
					$pro_image = $row_cat_pro['product_img1'];
					
					echo"<div id='single_product'><h3>$pro_title</h3>
					    <img src='admin_area/product_images/$pro_image' width='190' height='190' style='border:2px solid #333;' /><br>
						<p><b>Price:INR $pro_price </b></p>
						<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
						<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
						</div>
						";
				}	
		}	
}

//getting brand product
function getBrandPro(){
	             
				  global $db;
			if (isset($_GET['brand'])) {

			    $brand_id = $_GET['brand'];

			    $get_brand_pro = "select * from products where brand_id='$brand_id'";
				
				$run_brand_pro =mysqli_query($db,$get_brand_pro);

				$count = mysqli_num_rows($run_brand_pro);

				if($count==0){
					echo "<h2>No Products in this Brand</h2>";
				}
				
				while($row_brand_pro = mysqli_fetch_array($run_brand_pro))
				{
					$pro_id = $row_brand_pro['product_id'];
			        $pro_title = $row_brand_pro['product_title'];
					$pro_desc = $row_brand_pro['product_desc'];
					$pro_price = $row_brand_pro['product_price'];
					$pro_image = $row_brand_pro['product_img1'];
					
					echo"<div id='single_product'><h3>$pro_title</h3>
					    <img src='admin_area/product_images/$pro_image' width='190' height='190' style='border:2px solid #333;' /><br>
						<p><b>Price:INR $pro_price </b></p>
						<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
						<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
						</div>
						";
				}	
		}	
}




//getting brands to display
function getBrands(){
	                        global $db;
						     $get_brands = "select * from brands";
						     $run_brands = mysqli_query($db,$get_brands);
							 while($row_brands=mysqli_fetch_array($run_brands)){
								 $brand_id = $row_brands['brand_id'];
								 $brand_title = $row_brands['brand_title'];
									 
								echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
								 }
}


//getting category to display
function getCats(){
	                         global $db;
						     $get_cats = "select * from categories";
						     $run_cats = mysqli_query($db,$get_cats);
							 while($row_cats=mysqli_fetch_array($run_cats)){
								 $cat_id = $row_cats['cat_id'];
								 $cat_title = $row_cats['cat_title'];
									 
								echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
								 }
								 
}


//Creating the script for cart


function cart()
{

   if(isset($_GET['add_cart']))
   {

   	global $db;

   	$ip_add = getUserIP();

   	$p_id = $_GET['add_cart'];

   	$check_pro = "select * from cart where ip_add='$ip_add'AND p_id='$p_id'";

   	$run_check = mysqli_query($db,$check_pro);

   	$count = mysqli_num_rows($run_check);

   	/*if($count>0)
   	if ($result = mysqli_query($db, "select all from cart where ip_add='$ip_add'AND p_id='$p_id'")) { 
    $row = $result->fetch_assoc(); 
    if ($row['COUNT(*)'] > 0)
   	{
   		
   		echo "";
   	
   	}

     else{
*/     	$q = "insert into cart (p_id,ip_add) values ('$p_id','$ip_add')";

     	$run_q = mysqli_query($db,$q);

     	echo "<script>window.open('index.php','_self')</script>";
     }


   //}



}
//}

//getting the no of items from the cart

function items(){
		$ip_add = getUserIP();
	if(isset($_GET['add_cart'])){
		global $db;
		$get_items = "select * from cart where ip_add='$ip_add'";
		$run_items = mysqli_query($db,$get_items);
		$count_items = mysqli_num_rows($run_items);
	}
	else{
		global $db;
		$get_items = "select * from cart where ip_add='$ip_add'";
		$run_items = mysqli_query($db,$get_items);
		$count_items = mysqli_num_rows($run_items);
	}
		echo $count_items;
}

//getting total price of items from cart

function total_price(){

	$ip_add = getUserIP();

	global $db;

	$total = 0;

	$sel_price = "select * from cart where ip_add='$ip_add'";

	$run_price = mysqli_query($db,$sel_price);

	while ($record= mysqli_fetch_array($run_price)){

        $pro_id = $record['p_id'];

        $pro_price = "select * from products where product_id='$pro_id'";

        $run_pro_price = mysqli_query($db,$pro_price);

        while ($p_price=mysqli_fetch_array($run_pro_price)) {

        	$product_price = array($p_price['product_price']);
        	
        	$values = array_sum($product_price);

        	$total +=$values;


        }


	}
     echo "INR :".$total;
}

//to show if session is active then show logout else login
function sesan(){
				   		if (!isset($_SESSION['customer_email'])) {
				   			echo "<a href = 'customer_login.php' style='color:#F93;'>Login</a>";
				   		}
				   		elseif (isset($_SESSION['customer_email'])) {
				   		
				   	
				   			echo "<a href = 'logout.php' style='color:#F93;'>Logout</a>";
				   		}

				}



?>			


